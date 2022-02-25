<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\Meet;
use App\Models\MeetEvent;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MeetEventController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Meet $meet)
    {
        $meetEvents = MeetEvent::query()
            ->whereMeetId($meet->id)
            ->with('event')
            ->withCount('entries')
            ->orderBy('order')
            ->get();

        return Inertia::render('Admin/Entries/Events/EventsIndex', [
            'meet' => $meet,
            'events' => $meetEvents,
            'entries_count' => $meetEvents->sum('entries_count')
        ]);
    }

    /**
     * @param Meet $meet
     * @return \Illuminate\Http\RedirectResponse|\Inertia\Response
     */
    public function create(Meet $meet)
    {
        return Inertia::render('Admin/Entries/Events/EventsCreate', [
            'meet' => $meet,
            'allEvents' => Event::all(),
            'isEventsEmpty' => $meet->events()->get()->isEmpty(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Meet $meet)
    {
        if($meet->events()->get()->isNotEmpty()) {
            $meet->events()->detach();
        }

        collect($request->events)->each(function ($event, $key) use (&$meet) {
            // attach one by one beacuse event_id can be the same
            $meet->events()->attach([
                $event['event_id'] => [
                    'order' => $key + 1,
                    'category' => $event['category'] ?? null,
                ]
            ]);
        });

        return redirect()->route('admin:entries.meet.event.index', $meet)->with('success', 'Versenszámok sikeresen létrehozva');
    }

//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  \App\Models\Meet  $meet
//     * @return \Illuminate\Http\Response
//     */
//    public function edit(Meet $meet)
//    {
//        $eventList = $meet->events()->orderBy('order')->get()->map(function ($event, $key) {
//            return [
//                'id' => $key + 1,
//                'event_id' => $event['id'],
//                'length' => $event['length'],
//                'sex' => $event['sex'],
//                'swim' => $event['swim'],
//                'order' => $event->pivot['order'],
//                'category' => $event->pivot['category'] ?? null,
//            ];
//        });
//
//        return Inertia::render('Admin/Entries/Events/EventsEdit', [
//            'meet' => $meet,
//            'allEvents' => Event::all(),
//            'eventList' => $eventList
//        ]);
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\Models\Meet  $meet
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, Meet $meet)
//    {
//        $events = $request->validate([
//            'events' => 'array',
//        ])['events'];
//
//        $events = [];
//        foreacH($validated as $key => $event) {
//           $events[] = ['event_id' => $event['event_id'], 'order' => $key + 1, 'category' => $event['category'] ?? null];
//        }
//
//        $meet->events()->sync([
//            ['event_id' => 1, 'order' => 1, 'category' => 'a'],
//            ['event_id' => 1, 'order' => 2, 'category' => 'b'],
//            ['event_id' => 1, 'order' => 3, 'category' => 'c'],
//        ]);
//
//        $events = collect($events)->map(function ($event, $key)  {
//             return ['event_id' => $event['event_id'], 'order' => $event['order'], 'category' => $event['category'] ?? null];
//        })->toArray();
//
//        $eventsClass = collect($events)->mapInto(MeetEvent::class)->toArray();
//
//        $meet->events()->sync($eventsClass);
//
//        dd('update', $events, $eventsClass, $request->all());
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meet $meet)
    {
        //
    }
}
