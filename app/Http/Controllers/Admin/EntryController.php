<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\EntryRequest;
use App\Models\Competitor;
use App\Models\Entry;
use App\Models\Meet;
use App\Traits\EntryTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class EntryController extends BaseAdminController
{
    use EntryTrait;

    /**
     * Display the listing resource.
     *
     * @param  Request $request
     * @param  Meet $meet
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Meet $meet)
    {
        $request->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,event,is_final,time,user_id,created_at'],
        ]);

		$query = Competitor::query()
			->whereHas('entries', function ($query) use ($meet) {
				$query->whereMeetId($meet->id);
			})
			->withCount('entries')
			->with('entries');

        $query->when(
            $search = $request->get('search'),
            fn(Builder $query) => $query
                // search competitor's name
				->where('name', 'like', '%' . $search . '%')
        );

        if($request->has(['field', 'direction'])) {
            $direction = $request->get('direction');
            switch($request->get('field')) {
				case 'name':
					$query->orderBy('name', $direction);
                    break;
            }
        }else {
			$query->orderBy('name');
		}

		$competitors = $query->get()->map(function (Competitor $competitor) use ($meet) {

			$competitor->price = $competitor
					->entries()
					->whereMeetId($meet->id)
					->whereHas('meetEvent.event', fn($query) => $query->where('is_relay', false))
					->count() * $meet->entry_price;

			$competitor->is_final = $competitor->entries->where('is_final', false)->count() == 0;

			return $competitor;
		});

        $individual_entries_count = $meet
			->entries()
			->whereHas('meetEvent.event', fn($query) => $query->where('is_relay', false))
			->count();

		$relay_entries_count = $meet
			->entries()
			->whereHas('meetEvent.event', fn($query) => $query->where('is_relay', true))
			->count();

        return Inertia::render('Admin/Entries/EntriesIndex', [
            'meet' => $meet,
            'competitors' => $competitors,
            'filters' => request()->all(['search', 'field', 'direction', 'year']),
            'isEntrySet' => $meet->isEntryPriceSet() && $meet->entry_type !== null && $meet->entry_app !== null,
            'individual_entries_count' => $individual_entries_count,
            'relay_entries_count' => $relay_entries_count,
        ]);
    }

    /**
     * Show the form for eiting the specified resource.
     *
     * @param  \App\Models\Meet  $meet
     * @param  Competitor        $competitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Meet $meet, Competitor $competitor)
    {
        $entries = $meet
            ->entries()
            ->whereCompetitorId($competitor->id)
            ->get();

        if($entries->isEmpty()) {
            return redirect()->route('admin:entries.index', $meet);
        }

        return Inertia::render('Admin/Entries/EntriesEdit', [
            'meet' => $meet,
            'competitor' => $competitor->load('team'),
            'competitor_form' => $this->getCompetitorForm($competitor, $entries),
            'meet_events_by_gender' => $this->getMeetEventsByCompetitor($meet, $competitor)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meet  $meet
     * @param  Competitor        $competitor
     * @return \Illuminate\Http\Response
     */
    public function update(EntryRequest $request, Meet $meet, Competitor $competitor)
    {
        $competitor_id = $request->input('competitor_id');

        foreach($request->input('entries') as $key => $data) {
            $meet->entries()->updateOrCreate(
                [
                    'id' => $data['id'],
                ], [
                    'competitor_id' => $competitor_id,
                    'meet_event_id' => $data['meet_event_id'],
                    'min' => $data['time']['min'],
                    'sec' => $data['time']['sec'],
                    'milli' => $data['time']['milli'],
                    'is_final' => $data['is_final'] ?? false,
                    'is_paid' => $data['is_paid'] ?? false,
                ]
            );
        }

        return redirect()->back()->with('success', 'Nevezés sikeresen frissítve');
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

        return redirect()->route('admin:entries.index', $meet)->with('success', 'Nevezések sikeresen véglegesítve');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entry  $entry
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meet $meet, $entryId)
    {
        /** @var Entry $entry */
        $entry = Entry::findOrFail($entryId);

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
        $competitor->entries()->whereMeetId($meet->id)->delete();

        return redirect()->route('admin:entries.index', $meet)->with('success', 'Nevezések sikeresen törölve');
    }
}
