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
		$request->validate([
			'direction' => ['in:asc,desc'],
			'field' => ['in:name,team,is_final,created_at'],
		]);

		$query = Team::query()
			->whereHas('entries')
			->with('entries.meetEvent');

		$query->when(
			$search = $request->get('search'),
			fn(Builder $query) => $query
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
			'filters' => request()->all(['search', 'field', 'direction', 'year']),
			'teams' => $query->get(),
			'individual_entries_count' => $individual_entries_count,
			'relay_entries_count' => $relay_entries_count,
		]);
	}
}
