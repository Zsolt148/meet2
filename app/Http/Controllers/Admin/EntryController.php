<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\EntryRequest;
use App\Models\Entry;
use App\Models\Meet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EntryController extends BaseAdminController
{
    /**
     * Display the listing resource.
     *
     * @param  Request $request
     * @param  Meet $meet
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Meet $meet)
    {
        $request->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,event,is_final,time,created_at'],
        ]);

        $query = $meet->entries();

        $query->when(
            $search = $request->get('search'),
            fn(Builder $query) => $query
                // search competitor's name
                ->whereHas('competitor', function ($query) use ($search){
                    $query->where('name', 'like', '%' . $search . '%');
                })
                // search user's (nevezo) name
                ->orWhereHas('user', function ($query) use ($search){
                    $query->where('name', 'like', '%' . $search . '%');
                })
        );

        if($request->has(['field', 'direction'])) {
            $direction = $request->get('direction');
            switch($request->get('field')) {
                case 'name': //TODO fix competitor orderBy
                    $query->whereHas('competitor', function ($query) use (&$direction) {
                        $query->orderBy('name', $direction);
                    });
                    break;
                case 'event': //TODO fix event orderBy
                    $query->whereHas('meetEvent.event', function ($query) use (&$direction) {
                        $query->orderBy('length', $direction);
                    });
                    break;
                case 'is_final':
                    $query->orderBy('is_final', $direction);
                    break;
                case 'time':
                    $query->orderBy('min', $direction)
                        ->orderBy('sec', $direction)
                        ->orderBy('milli', $direction);
                    break;
                case 'created_at':
                    $query->orderBy('created_at', $direction);
                    break;
                default:
                    break;
            }
        }else {
            $query->latest();
        }

        return Inertia::render('Admin/Entries/EntriesIndex', [
            'meet' => $meet,
            'entries' => $query->paginate()->withQueryString(),
            'filters' => request()->all(['search', 'field', 'direction', 'year']),
            'isEntrySet' => $meet->isEntryPriceSet() && $meet->entry_type !== null && $meet->entry_app !== null,
            'entries_count' => $meet->entries()->count()
        ]);
    }

    /**
     * Show the form for eiting the specified resource.
     *
     * @param  \App\Models\Meet  $meet
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Meet $meet, Entry $entry)
    {
        return Inertia::render('Admin/Entries/EntriesEdit', [
            'meet' => $meet,
            'entry' => $entry->load('competitor', 'user', 'meetEvent'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meet  $meet
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(EntryRequest $request, Meet $meet, Entry $entry)
    {
        $entry->update([
            'is_final' => $request->get('is_final'),
            'is_paid' => $request->get('is_paid'),
            'min' => $request->get('time')['min'],
            'sec' => $request->get('time')['sec'],
            'milli' => $request->get('time')['milli'],
        ]);

        return redirect()->route('admin:entries.index', $meet)->with('success', 'Nevezés sikeresen frissítve');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entry  $entry
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meet $meet, Entry $entry)
    {
        $entry->delete();

        return redirect()->route('admin:entries.index', $meet)->with('success', 'Nevezés sikeresen törölve');

    }
}
