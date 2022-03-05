<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portal\EntryRequest;
use App\Models\Competitor;
use App\Models\Entry;
use App\Models\Meet;
use App\Traits\EntryTrait;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class EntryController extends Controller
{
    use EntryTrait;

    /**
     * Show the form for creating a new resource.
     * @param Meet $meet
     * @return \Illuminate\Http\Response
     */
    public function create(Meet $meet)
    {
        Gate::authorize('create', Entry::class);

        // Ensure the deadline is ok and if its entriable
        abort_if(!$meet->is_deadline_ok || !$meet->is_entriable, 404);

        [$male, $female] = $this->getMeetEventsByGender($meet);

        // get users's competitors
        // where competitor doesnt have any entry
        if($competitors = auth()->user()->competitors()) {
            $entriedCompetitors = $meet->entries()->get()->pluck('competitor.id')->unique();
            $competitors = $competitors->whereNotIn('id', $entriedCompetitors)->values();
        }

        return Inertia::render('Portal/Meets/Entries/EntriesCreate', [
            'meet' => $meet,
            'male_meet_events' => $male,
            'female_meet_events' => $female,
            'competitors' => $competitors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\EntryRequest  $request
     * @param Meet $meet
     * @return \Illuminate\Http\Response
     */
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

        $user_id = auth()->user()->id;
        $competitor_id = $request->input('competitor_id');

        foreach($request->input('entries') as $key => $data) {
            $meet->entries()->create([
                'user_id' => $user_id,
                'competitor_id' => $competitor_id,
                'meet_event_id' => $data['meet_event_id'],
                'min' => $data['time']['min'],
                'sec' => $data['time']['sec'],
                'milli' => $data['time']['milli'],
            ]);
        }

        return redirect()->route('portal:meets.show', $meet)->with('success', 'Nevezés sikeresen létrehozva');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meet   $meet
     * @param  $competitorId
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meet   $meet
     * @param  Competitor $competitor
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meet   $meet
     * @param  Competitor $competitor
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Finalize the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
    *  @param  \App\Models\Meet     $meet
     * @param  Competitor           $competitor
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Finalize all the entries by the user
     *
     * @param Meet $meet
     * @return \Illuminate\Http\RedirectResponse
     */
    public function finalizeAll(Meet $meet)
    {
        Gate::authorize('viewAny', Entry::class);

        /* users's entries
        auth()
            ->user()
            ->entries()
            ->whereMeetId($meet->id)
            ->whereIsFinal(false)
            ->update([
                'is_final' => true,
            ])
        */

        // team's entries
        Entry::query()
            ->whereMeetId($meet->id)
            ->whereIsFinal(false)
            ->with('competitor', 'meetEvent')
            ->whereHas('competitor', function ($query) {
                $query->where('team_id', auth()->user()->team_id);
            })
            ->update([
                'is_final' => true,
            ]);

        return redirect()->route('portal:meets.show', $meet)->with('success', 'Nevezések sikeresen véglegesítve');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meet   $meet
     * @param  Entry $entry
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meet   $meet
     * @param  Competitor $competitor
     * @return \Illuminate\Http\Response
     */
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
