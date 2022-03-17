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
			->whereHas('competitor', function ($query) {
				$query->orderBy('name');
		});

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
			$team = $request->get('team'),
			fn(Builder $query) => $query
				->whereHas('user', function ($query) use ($team) {
					$query->where('team_id', $team);
				})
		);

		$entries = $query->get()->groupBy('meet_event_id');

		return Inertia::render('Site/Meets/Entries/EntriesIndex', [
			'filters' => request()->all(['search', 'team', 'field', 'direction']),
			'meet' => $meet,
			'events' => $events->intersectByKeys($entries),
			'entries' => $entries,
			'teams' => $teams,
		]);
    }
}
