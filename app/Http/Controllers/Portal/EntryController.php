<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portal\EntryRequest;
use App\Models\Entry;
use App\Models\Meet;
use App\Models\MeetEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
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
        Gate::authorize('create', Entry::class);

        // Ensure the deadline is ok and if its entriable
        abort_if(!$meet->is_deadline_ok || !$meet->is_entriable, 404);

        $meetEvents = MeetEvent::query()
            ->whereMeetId($meet->id)
            ->with('event')
            ->orderBy('order')
            ->get();

        return Inertia::render('Portal/Meets/Entries/EntriesCreate', [
            'meet' => $meet,
            'meet_events' => $meetEvents,
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
        Gate::authorize('create', Entry::class);

        // Ensure the deadline and if its entriable
        abort_if(!$meet->is_deadline_ok || !$meet->is_entriable, 404);

        // if the competitor already has the event
        // show validation error
        if($meet
            ->entries()
            ->whereCompetitorId($request->input('competitor_id'))
            ->whereMeetEventId($request->input('meet_event_id'))
            ->exists()
        ) {
            throw ValidationException::withMessages(['meet_event_id' => trans('validation.already_entered')]);
        }

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
     * @param  \App\Models\Meet   $meet
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Meet $meet, Entry $entry)
    {
        Gate::authorize('view', $entry);

        return Inertia::render('Portal/Meets/Entries/EntriesShow', [
            'meet' => $meet,
            'meet_event' => meetEvent($entry->meetEvent),
            'entry' => $entry->load('competitor'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meet   $meet
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Meet $meet, Entry $entry)
    {
        Gate::authorize('update', $entry);

        // Ensure the deadline is ok
        // and if it is finalized entry
        // redirect to show
        if(!$meet->is_deadline_ok || $entry->isFinal()) {
            return redirect()->route('portal:meet.entry.show', [$meet, $entry]);
        }

        return Inertia::render('Portal/Meets/Entries/EntriesEdit', [
            'meet' => $meet,
            'meet_event' => meetEvent($entry->meetEvent),
            'entry' => $entry->load('competitor'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meet   $meet
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(EntryRequest $request, Meet $meet, Entry $entry)
    {
        Gate::authorize('update', $entry);

        // Ensure the deadline is ok
        // and if it is finalized entry abort
        abort_if(!$meet->is_deadline_ok || $entry->isFinal(), 503);

        $entry->update($request->only('time'));

        return redirect()->route('portal:meets.show', $meet->slug)->with('success', 'Nevezés sikeresen frissítve');
    }

    /**
     * Finalize the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
    *  @param  \App\Models\Meet   $meet
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function finalize(EntryRequest $request, Meet $meet, Entry $entry)
    {
        Gate::authorize('update', $entry);

        $entry->update([
            $request->only('time'),
            'is_final' => true,
        ]);

        return redirect()->route('portal:meets.show', $meet->slug)->with('success', 'Nevezés sikeresen véglegesítve');
    }

    /**
     * Finalize all the entries by the user
     *
     * @param Meet $meet
     * @return \Illuminate\Http\RedirectResponse
     */
    public function finalizeAll(Meet $meet)
    {
        Gate::authorize('viewAny', Entry::class);

        auth()
            ->user()
            ->entries()
            ->whereMeetId($meet->id)
            ->whereIsFinal(false)
            ->update([
                'is_final' => true,
            ]);

        return redirect()->route('portal:meets.show', $meet)->with('success', 'Nevezések sikeresen véglegesítve');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meet   $meet
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(meet $meet, Entry $entry)
    {
        Gate::authorize('delete', $entry);

        // Ensure the deadline is ok
        // and if it is finalized entry abort
        abort_if(!$meet->is_deadline_ok || $entry->isFinal(), 503);

        $entry->delete();

        return redirect()->route('portal:meets.show', $meet)->with('success', 'Nevezések sikeresen véglegesítve');
    }
}
