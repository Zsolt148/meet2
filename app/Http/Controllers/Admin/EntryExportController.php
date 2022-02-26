<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CompetitorExport;
use App\Exports\EntryExport;
use App\Exports\TeamExport;
use App\Http\Controllers\Controller;
use App\Models\Entry;
use App\Models\Meet;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EntryExportController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param Meet $meet
     * @return \Illuminate\Http\Response
     */
    public function index(Meet $meet)
    {
        return Inertia::render('Admin/Entries/Exports/ExportsIndex', [
            'meet' => $meet,
        ]);
    }

    /**
     * @param Meet $meet
     * @return \Illuminate\Http\Response
     */
    public function competitors(Meet $meet)
    {
        return new CompetitorExport($meet->id);
    }

    /**
     * @param Meet $meet
     * @return \Illuminate\Http\Response
     */
    public function teams(Meet $meet)
    {
        // unique team ids in the meet
        $teamIds = Entry::query()
            ->whereMeetId($meet->id)
            ->with('competitor')
            ->get()
            ->pluck('competitor.team_id')
            ->unique();

        return new TeamExport($teamIds);
    }

    /**
     * @param Meet $meet
     * @return \Illuminate\Http\Response
     */
    public function entries(Meet $meet)
    {
        return new EntryExport($meet->id);
    }
}
