<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CompetitorExport;
use App\Exports\EntryExport;
use App\Exports\TeamExport;
use App\Models\Meet;
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
        return new TeamExport($meet->id);
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
