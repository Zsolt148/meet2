<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Meet;
use App\Models\MeetEvent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MeetEntryController extends Controller
{

	/**
	 * @param Request $request
	 * @param Meet    $meet
	 * @return \Inertia\Response
	 */
	public function index(Request $request, Meet $meet)
	{
		abort_if(!$meet->isEntriable(), 404);

		$events = MeetEvent::query()
			->whereMeetId($meet->id)
			->with('event')
			->withCount('entries')
			->orderBy('order')
			->get()
			->mapWithKeys(function ($event, $key) {
				return [$event->id => $event];
			});

		$query = $meet
			->entries()
			->with('competitor');

		$teams = (clone $query)
			->get()
			->pluck('competitor.team')
			->unique();

		$query->when(
			$search = $request->get('search'),
			fn(Builder $query) => $query
				// search competitor's name
				->whereHas('competitor', function ($query) use ($search) {
					$query->where('name', 'like', '%' . $search . '%');
				})
		);

		$query->when(
			$event = $request->get('event'),
			fn(Builder $query) => $query
				->where('meet_event_id', $event)
		);

		$query->when(
			$team = $request->get('team'),
			fn(Builder $query) => $query
				->whereHas('user', function ($query) use ($team) {
					$query->where('team_id', $team);
				})
		);

		$entries = $query
			->get()
			->sortBy('competitor.name')
			->groupBy('meet_event_id');

		return Inertia::render('Site/Meets/Entries/EntriesIndex', [
			'filters' => request()->all(['search', 'event', 'team', 'field', 'direction']),
			'meet' => $meet,
			'all_events' => $events,
			'events' => $events->intersectByKeys($entries),
			'entries' => $entries,
			'teams' => $teams,
		]);
    }

	public function statistics(Request $request, Meet $meet)
	{
		$query = $meet
			->entries()
			->with('competitor');

		$collection = (clone $query)
			->get()
			->groupBy('competitor.team.name');

		$collection = $collection
			->transform(function ($data, $key) use (&$meet) {

				$array['name'] = $key;

				$array['competitors_count'] = $data->pluck('competitor_id')->unique()->count();
				$array['man_count'] = $data->where('competitor.sex', 'F')->unique('competitor_id')->count();
				$array['woman_count'] = $data->where('competitor.sex', 'N')->unique('competitor_id')->count();

				$array['individual_entries_count'] = $data->where('meetEvent.event.is_relay', 0)->count();
				$array['relay_entries_count'] = $data->where('meetEvent.event.is_relay', 1)->count();

				return $array;
			})
			->sortBy('name');

		$competitors = (clone $query)
			->get()
			->groupBy('competitor.name')
			->count();

		$individual_entries_count = $meet
			->entries()
			->whereHas('meetEvent.event', fn($query) => $query->where('is_relay', false))
			->count();

		$relay_entries_count = $meet
			->entries()
			->whereHas('meetEvent.event', fn($query) => $query->where('is_relay', true))
			->count();

		return Inertia::render('Site/Meets/Entries/StatisticsIndex', [
			'meet' => $meet,
			'competitors_count' => $competitors,
			'teams' => $collection,
			'individual_entries_count' => $individual_entries_count,
			'relay_entries_count' => $relay_entries_count,
		]);
	}
}
