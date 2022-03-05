<?php

namespace App\Http\Controllers\Admin;

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
        $query = $this->getQuery(Team::class, request(), ['name', 'type', 'SA', 'address']);

        return Inertia::render('Admin/Teams/TeamsIndex', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'teams' => $query->paginate()->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
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
                    'address' => $team['address'],
                ]
            );
        }

        return back()->with('success', 'Sikeres szinkronizálás');
    }
}
