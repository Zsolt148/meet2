<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portal\EntryRequest;
use App\Models\Entry;
use App\Models\Meet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class EntryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @param Meet $meet
     * @return \Illuminate\Http\Response
     */
    public function create(Meet $meet)
    {
        Gate::allows('team-leader');

        return Inertia::render('Portal/Meets/Entries/EntriesCreate', [
            'meet' => $meet,
            'events' => $meet->events()->get(),
            'competitors' => auth()->user()->competitors(),
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
        Gate::allows('team-leader');

        $meet->entries()->create([
            'user_id' => auth()->user()->id,
            'competitor_id' => $request->input('competitor_id'),
            'meet_event_id' => $request->input('meet_event_id'),
            'time' => $request->input('time'),
        ]);

        return redirect()->route('portal:meets.show', $meet)->with('success', 'Nevezés sikeresen létrehozva');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {
        //
    }
}
