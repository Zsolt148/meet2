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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
		return Inertia::render('Admin/Teams/TeamsEdit', [
			'team' => $team
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

        foreach($teams as $team) {
            Team::updateOrCreate(
                [
                    'SA' => $team['SA'],
                ], [
                    'name' => $team['name'],
                    'type' => Team::TYPE_SENIOR,
                    'short' => $team['short'] ?? null,
                    'meet_abbr' => $team['meet_abbr'] ?? null,
                    'country' => $team['country'] ?? 'HU',
                    'address' => $team['address'],
					'deleted_at' => $team['deleted_at'],
                ]
            );
        }

        return back()->with('success', 'Sikeres szinkronizálás');
    }
}
