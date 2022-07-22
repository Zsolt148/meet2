<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\EntryRequest;
use App\Models\Competitor;
use App\Models\Entry;
use App\Models\Meet;
use App\Models\Team;
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
            'field' => ['in:name,team,is_final,created_at'],
        ]);

		$query = Competitor::query()
			->with(['entries' => function ($q) use (&$meet) {
				$q->where('meet_id', $meet->id);
			}])
			->whereHas('entries', function ($q) use (&$meet) {
				$q->where('meet_id', $meet->id);
			})
			->with('team');

        $query->when(
            $search = $request->get('search'),
            fn(Builder $query) => $query
                // search competitor's name
				->where('name', 'like', '%' . $search . '%')
//				->orWhereHas('team', function ($q) use (&$search) {
//					$q->where('name', 'like', '%' . $search . '%');
//				})
        );

        if($request->has(['field', 'direction'])) {
            $direction = $request->get('direction');
            switch($request->get('field')) {
				case 'name':
					$query->orderBy('name', $direction);
                    break;
				case 'team':
					$query->orderBy('team_id', $direction);
					break;
            }
        }else {
			$query->orderBy('name');
		}

		$competitors = $query->get()->map(function (Competitor $competitor) use ($meet) {

			// TODO do the same in EntryTeamController.php
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
	 * Show the form for creating a new resource.
	 * @param Meet $meet
	 * @return \Illuminate\Http\Response
	 */
	public function create(Meet $meet)
	{
		[$male, $female] = $this->getMeetEventsByGender($meet);

		// get users's competitors
		// where competitor doesnt have any entry
		if($competitors = Competitor::all()) {
			$entriedCompetitors = $meet->entries()->get()->pluck('competitor.id')->unique();
			$competitors = $competitors->whereNotIn('id', $entriedCompetitors)->values();
		}

		return Inertia::render('Admin/Entries/EntriesCreate', [
			'meet' => $meet,
			'male_meet_events' => $male,
			'female_meet_events' => $female,
			'competitors' => $competitors,
			'teams' => Team::all(),
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
		// ensure competitor doesnt have any entry yet
		abort_if(
			$meet->entries()->whereCompetitorId($request->input('competitor_id'))->exists(),
			403
		);

		$this->validateDuplicateEvents($request);

		$user = auth()->user();
		$competitor_id = $request->input('competitor_id');

		// create new competitor
		if($competitor_id == 'other') {

			/** @var Competitor $competitor */
			$competitor = Competitor::create([
				'team_id' => $request->input('team_id'),
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

		return redirect()->route('admin:entries.index', $meet)->with('success', 'Nevezés sikeresen létrehozva');
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

		$teams = Team::query()
			->senior()
			->other()
			->orderBy('name')
			->get()
			->push(Team::individual());

        return Inertia::render('Admin/Entries/EntriesEdit', [
            'meet' => $meet,
			'teams' => $teams,
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

		$this->validateDuplicateEvents($request);

		$competitor->update([
			'name' => $request->input('competitor_name'),
			'team_id' => $request->input('team_id')
		]);

		foreach($request->input('entries') as $key => $data) {
			// if entry already exists, update it
			if($data && isset($data['id'])) {
				// TODO fix me ?
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
			}else {
				$meet->entries()->create([
					'user_id' => auth()->user()->id,
					'competitor_id' => $competitor_id,
					'meet_event_id' => $data['meet_event_id'],
					'min' => $data['time']['min'],
					'sec' => $data['time']['sec'],
					'milli' => $data['time']['milli'],
					'is_final' => $data['is_final'] ?? false,
					'is_paid' => $data['is_paid'] ?? false,
				]);
			}
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
