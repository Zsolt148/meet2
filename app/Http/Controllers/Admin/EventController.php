<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = $this->getQuery(Event::class, request(), ['length']);

        return Inertia::render('Admin/Events/EventsIndex', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'events' => $query->paginate()->withQueryString()
        ]);
    }
}
