<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meet;
use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EntryTeamController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request, Meet $meet)
	{
		$collection = $meet
			->entries()
			->get()
			->groupBy('competitor.team.name');

		$collection = $collection
			->transform(function ($data, $key) use (&$meet) {

				$array['name'] = $key;
				$count = $data->where('meetEvent.event.is_relay', 0)->count();
				$array['individual_entries_count'] = $count;
				$array['individual_entries_price'] = $count * $meet->entry_price;
				$array['team_entries_count'] = $data->where('meetEvent.event.is_relay', 1)->count();
				$array['competitors_count'] = $data->pluck('competitor_id')->unique()->count();

				return $array;
			})
			->sortBy('name');


		if($search = $request->get('search')) {
			$collection = $collection->filter(function ($data) use ($search) {
				return false !== stripos($data['name'], $search);
			});
		}

		$individual_entries_count = $meet
			->entries()
			->whereHas('meetEvent.event', fn($query) => $query->where('is_relay', false))
			->count();

		$relay_entries_count = $meet
			->entries()
			->whereHas('meetEvent.event', fn($query) => $query->where('is_relay', true))
			->count();

		return Inertia::render('Admin/Entries/Teams/TeamsIndex', [
			'meet' => $meet,
			'filters' => request()->all(['search']),
			'teams' => $collection,
			'individual_entries_count' => $individual_entries_count,
			'relay_entries_count' => $relay_entries_count,
		]);
	}
}
