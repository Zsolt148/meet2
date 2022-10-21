<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TeamRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class TeamController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = $this->getQuery(Team::class, request(), ['name', 'type', 'country', 'SA', 'address']);

        return Inertia::render('Admin/Teams/TeamsIndex', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'teams' => $query->paginate()->withQueryString()
        ]);
    }

	/**
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return Inertia::render('Admin/Teams/TeamsCreate', [
			'types' => Team::CREATE_TYPES,
		]);
	}

	public function store(TeamRequest $request)
	{
		$team = new Team();

		$team->fill($request->only(
			'name',
			'type',
			'short',
			'meet_abbr',
			'SA',
			'country',
			'address'
		));

		$team->save();

		return redirect()->route('admin:teams.index')->with('success', 'Egyesület sikeresen létrehozva');
	}

    /**
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
		return Inertia::render('Admin/Teams/TeamsEdit', [
			'team' => $team,
			'types' => Team::TYPES,
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(TeamRequest $request, Team $team)
    {
        $team->update($request->only(
        	'name',
			'short',
			'meet_abbr',
			'SA',
			'country',
			'address'
		));

        return redirect()->route('admin:teams.index')->with('success', 'Egyesület sikeresen frissítve');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();

		return redirect()->route('admin:teams.index')->with('success', 'Egyesület sikeresen törölve');
	}

    public function sync()
    {
        $response = Http::get('https://mszuosz.hu/api/teams');

        $response->throw();

        $teams = $response->json();

        foreach($teams as $data) {

        	if(!$data['SA']) {
        		continue;
			}

        	/** @var Team $team */
			$team = Team::query()
				->withTrashed()
				->where('SA', $data['SA'])
				->first();

			if(!$team) {
				$team = new Team(['SA' => $data['SA']]);
			}

        	$team->name = $data['name'];
        	$team->type = Team::TYPE_SENIOR;
        	$team->short = $data['short'];
        	$team->meet_abbr = $data['meet_abbr'];
        	$team->country = $data['country'] ?? 'HU';
        	$team->address = $data['address'];
        	$team->deleted_at = $data['deleted_at'];

        	$team->save();
        }

        return back()->with('success', 'Sikeres szinkronizálás');
    }
}
