<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meet;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class MeetEntryController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = $this->getQuery(Meet::query()->entriable(), request(), ['name', 'entry_type', 'date']);

        return Inertia::render('Admin/Entries/MeetsIndex', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'meets' => $query->paginate()->withQueryString()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Meet $meet
     * @return \Illuminate\Http\Response
     */
    public function show(Meet $meet)
    {
        $query = $this->getQuery($meet->events(), request(), ['name']);
        //$query = $meet->

        return Inertia::render('Admin/Entries/MeetsShow', [
            'meet' => $meet,
            'entries' => $query->paginate()->withQueryString(),
            'filters' => request()->all(['search', 'field', 'direction', 'year']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Meet $meet
     * @return \Illuminate\Http\Response
     */
    public function edit(Meet $meet)
    {
        return Inertia::render('Admin/Entries/MeetsEdit', [
            'meet' => $meet,
            'entryTypes' => Meet::ENTRY_TYPES,
            'entryApps' => Meet::ENTRY_APPS
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Meet $meet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meet $meet)
    {
        $data = $request->validate([
            'is_entriable' => ['nullable'],
            'entry_price' => ['required_if:is_entriable,true', 'integer'],
            'entry_type' => ['required_if:is_entriable,true', 'nullable', Rule::in(Meet::ENTRY_TYPES)],
            'entry_app' => ['required_if:is_entriable,true', 'nullable', Rule::in(Meet::ENTRY_APPS)],
        ]);

        $meet->update($data);

        return redirect()->back()->with('success', 'Sikeresen frissítve');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
