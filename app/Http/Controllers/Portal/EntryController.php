<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portal\EntryRequest;
use App\Models\Competitor;
use App\Models\Entry;
use App\Models\Meet;
use App\Traits\EntryTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class EntryController extends Controller
{
    use EntryTrait;

    public function create(Meet $meet)
    {
        Gate::authorize('create', Entry::class);

        // Ensure the deadline is ok and if its entriable
        abort_if(!$meet->is_deadline_ok || !$meet->is_entriable, 404);

        [$male, $female] = $this->getMeetEventsByGender($meet);

        // get users's competitors
        // where competitor doesnt have any entry
        $entriedCompetitors = $meet->entries()->pluck('competitor_id')->unique();
        $competitors = auth()->user()
            ->competitors()
            ->whereNotIn('id', $entriedCompetitors)
            ->get();

        return Inertia::render('Portal/Meets/Entries/EntriesCreate', [
            'meet' => $meet,
            'male_meet_events' => $male,
            'female_meet_events' => $female,
            'competitors' => $competitors,
        ]);
    }

    public function store(EntryRequest $request, Meet $meet)
    {
        Gate::authorize('create', Entry::class);

        // Ensure the deadline and if its entriable
        // and competitor doesnt have any entry yet
        abort_if(
            !$meet->is_deadline_ok ||
            !$meet->is_entriable ||
            $meet->entries()->whereCompetitorId($request->input('competitor_id'))->exists(),
            403
        );

        $this->validateDuplicateEvents($request);

        $user = auth()->user();
        $competitor_id = $request->input('competitor_id');

        // ne lehessen "másik" Egyéni / csapattárs versenyzőjét használni
        if ($competitor_id !== 'other') {
            abort_unless(
                $user->competitors()->whereKey($competitor_id)->exists(),
                403
            );
        }

        // create new competitor
        if($competitor_id == 'other') {

            $this->validateDuplicateCompetitor($request, $user->team_id);

        	/** @var Competitor $competitor */
        	$competitor = Competitor::create([
        		'team_id' => $user->team_id,
        		'user_id' => optional($user->team)->type === \App\Models\Team::TYPE_INDIVIDUAL ? $user->id : null,
        		'name' => $request->input('competitor_name'),
        		'birth' => $request->input('competitor_birth'),
        		'sex' => $request->input('competitor_sex'),
				'type' => $meet->entry_type
			]);

			$competitor_id = $competitor->id;
		}

        foreach($request->input('entries') as $key => $data) {
            $meet->entries()->create([
                'user_id' => $user->id,
                'competitor_id' => $competitor_id,
                'meet_event_id' => $data['meet_event_id'],
                'min' => $data['time']['min'],
                'sec' => $data['time']['sec'],
                'milli' => $data['time']['milli'],
            ]);
        }

        return redirect()->route('portal:meets.show', $meet)->with('success', 'Nevezés sikeresen létrehozva');
    }

    public function show(Meet $meet, Competitor $competitor)
    {
        Gate::authorize('view', $competitor);

        $entries = $meet
            ->entries()
            ->whereCompetitorId($competitor->id)
            ->get();

        return Inertia::render('Portal/Meets/Entries/EntriesShow', [
            'meet' => $meet,
            'competitor' => $competitor,
            'competitor_form' => $this->getCompetitorForm($competitor, $entries),
            'meet_events_by_gender' => $this->getMeetEventsByCompetitor($meet, $competitor)
        ]);
    }

    public function edit(Meet $meet, Competitor $competitor)
    {
        Gate::authorize('update', $competitor);

		// Ensure the deadline is ok
        // and if it is finalized entry
        // redirect to show
        if(!$meet->is_deadline_ok || !auth()->user()->hasTeam()) {
            return redirect()->route('portal:meet.entry.show', [$meet, $competitor]);
        }

        $entries = $meet
            ->entries()
            ->whereCompetitorId($competitor->id)
            ->get();

        if($entries->isEmpty()) {
            return redirect()->route('portal:meets.show', $meet);
        }

        return Inertia::render('Portal/Meets/Entries/EntriesEdit', [
            'meet' => $meet,
            'competitor' => $competitor,
            'competitor_form' => $this->getCompetitorForm($competitor, $entries),
            'meet_events_by_gender' => $this->getMeetEventsByCompetitor($meet, $competitor)
        ]);
    }

    public function update(EntryRequest $request, Meet $meet, Competitor $competitor)
    {
        Gate::authorize('update', $competitor);

        // Ensure the deadline and if its entriable
        // and competitor doesnt have any entry yet
        abort_if(
            !$meet->is_deadline_ok ||
            !$meet->is_entriable,
            403
        );

        $this->validateDuplicateEvents($request);

        $user_id = auth()->user()->id;
        $competitor_id = $request->input('competitor_id');

        foreach($request->input('entries') as $key => $data) {
            $meet->entries()->updateOrCreate(
                [
                    'competitor_id' => $competitor_id,
                    'meet_event_id' => $data['meet_event_id'],
                    'meet_id' => $meet->id
                ], [
                    'user_id' => $user_id,
                    'min' => $data['time']['min'],
                    'sec' => $data['time']['sec'],
                    'milli' => $data['time']['milli'],
                ]
            );
        }

        return redirect()->route('portal:meets.show', $meet->slug)->with('success', 'Nevezés sikeresen frissítve');
    }

    public function finalize(EntryRequest $request, Meet $meet, Competitor $competitor)
    {
        Gate::authorize('update', $competitor);

        $competitor
            ->entries()
            ->whereMeetId($meet->id)
            ->whereIsFinal(false)
            ->update([
                'is_final' => true,
            ]);

        return redirect()->route('portal:meets.show', $meet->slug)->with('success', 'Nevezések sikeresen véglegesítve');
    }

    public function finalizeAll(Meet $meet)
    {
        Gate::authorize('viewAny', Entry::class);

        $user = auth()->user();
        $competitorIds = $user->competitors()->pluck('id');

        Entry::query()
            ->whereMeetId($meet->id)
            ->whereIsFinal(false)
            ->whereIn('competitor_id', $competitorIds)
            ->update([
                'is_final' => true,
            ]);

        return redirect()->route('portal:meets.show', $meet)->with('success', 'Nevezések sikeresen véglegesítve');
    }

    public function destroy(Meet $meet, $entryId)
    {
        /** @var Entry $entry */
        $entry = Entry::findOrFail($entryId);

        Gate::authorize('delete', $entry);

        // Ensure the deadline is ok
        // and if it is finalized entry abort
        abort_if(!$meet->is_deadline_ok || $entry->is_final, 403);

        $entry->delete();
    }

    public function destroyAll(Meet $meet, Competitor $competitor)
    {
        Gate::authorize('delete', $competitor);

        // Ensure the deadline is ok
        // and if it is finalized entry abort
        abort_if(!$meet->is_deadline_ok, 403);

        $competitor->entries()->whereMeetId($meet->id)->delete();

        return redirect()->route('portal:meets.show', $meet)->with('success', 'Nevezések sikeresen törölve');
    }
}
