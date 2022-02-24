<?php

namespace App\Http\Controllers\Admin;

use App\Models\Competitor;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class CompetitorController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = $this->getQuery(Competitor::query()->with('team'), request(), ['name', 'type', 'birth', 'sex']);

        return Inertia::render('Admin/Competitors/CompetitorsIndex', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'competitors' => $query->paginate()->withQueryString()
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
     * @param  \App\Models\Competitor  $competitor
     * @return \Illuminate\Http\Response
     */
    public function show(Competitor $competitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Competitor  $competitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Competitor $competitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Competitor  $competitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competitor $competitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Competitor  $competitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competitor $competitor)
    {
        //
    }

    public function sync()
    {
        $response = Http::get('https://engedely.mszuosz.hu/api/competitors');

        $response->throw();

        $competitors = $response->json();

        foreach($competitors as $competitor) {
            // team by unique SA
            $team = Team::query()->where('SA', $competitor['team_sa'])->first();

            Competitor::updateOrCreate(
                [
                    'foreign_id' => $competitor['id'],
                ], [
                    'team_id' => $team ? $team->id : null,
                    'name' => $competitor['name'],
                    'birth' => $competitor['birth'],
                    'sex' => isset($competitor['sex']) ? $competitor['sex'] : null,
                    'type' => Competitor::TYPE_SENIOR,
                    //'created_at' => $team['created_at'], // TODO parse error from get attribute
                ]
            );
        }

        return back()->with('success', 'Sikeres szinkronizálás');
    }
}
