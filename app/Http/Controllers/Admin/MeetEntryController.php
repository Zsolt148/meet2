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
        $query = $this->getQuery(Meet::query()->entriable(), request(), ['name', 'date']);

        return Inertia::render('Admin/Entries/MeetsIndex', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'meets' => $query->paginate()->withQueryString()
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
     * @param  Meet $meet
     * @return \Illuminate\Http\Response
     */
    public function show(Meet $meet)
    {
        $query = $this->getQuery(Meet::query()->entriable(), request(), ['name']);

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
        if(!$meet->is_entriable) {
            $meet->update(['is_entriable' => true]);
        }

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
            'entry_price' => ['required', 'integer'],
            'entry_type' => ['required', Rule::in(Meet::ENTRY_TYPES)],
            'entry_app' => ['required', Rule::in(Meet::ENTRY_APPS)],
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
