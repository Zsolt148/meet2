<?php

namespace App\Http\Controllers\Admin;

use App\Models\Meet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class MeetController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = $this->getQuery(Meet::class, request(), ['name', 'host', 'type', 'date']);

        if($year = request('year')) {
            $query->where('date', 'LIKE', '%'.$year.'%');
        }

        for($i = 0; $i < 8; $i++) {
            $years[] = Carbon::now()->subYear($i)->format('Y');
        }

        return Inertia::render('Admin/Meets/MeetsIndex', [
            'filters' => request()->all(['search', 'field', 'direction', 'year']),
            'meets' => $query->paginate()->withQueryString(),
            'years' => $years,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Meets/MeetsCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());

        return redirect()->route('admin:meets.index')->with('success', 'Verseny sikeresen létrehozva');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function show(Meet $meet)
    {
        return redirect()->route('meets.show', $meet->slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function edit(Meet $meet)
    {
        return Inertia::render('Admin/Meets/MeetsEdit', [
            'meet' => $meet,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meet $meet)
    {
        $meet->update($request->all());

        return redirect()->back()->with('success', 'Verseny sikeresen frissítve');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meet $meet)
    {
        $meet->delete();

        return redirect()->route('admin:meets.index')->with('success', 'Verseny sikeresen frissítve');
    }
}
