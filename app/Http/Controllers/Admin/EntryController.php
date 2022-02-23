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
            'field' => ['in:created_at,'],
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

        return Inertia::render('Admin/Entries/EntriesIndex', [
            'meet' => $meet,
            'entries' => $query->paginate()->withQueryString(),
            'filters' => request()->all(['search', 'field', 'direction', 'year']),
            'isEntrySet' => $meet->isEntryPriceSet() && $meet->entry_type !== null && $meet->entry_app !== null,
        ]);
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
            'entry' =>  $entry->load('competitor', 'user', 'meetEvent'),
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

        return redirect()->route('admin:entries.index', $meet);
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
