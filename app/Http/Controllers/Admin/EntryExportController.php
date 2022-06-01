<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MeetManager\CompetitorExport;
use App\Exports\MeetManager\EntryExport;
use App\Exports\MeetManager\TeamExport;
use App\Exports\Uszas\EntryExport as UszasEntryExport;
use App\Exports\Uszas\TeamExport as UszasTeamExport;
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
		switch($meet->entry_app) {
			case Meet::ENTRY_APP_MEET_MANAGER_CSV:
				return new CompetitorExport($meet->id);

			default:
				return back();
		}
    }

    /**
     * @param Meet $meet
     * @return \Illuminate\Http\Response
     */
    public function teams(Meet $meet)
    {
		switch($meet->entry_app) {
			case Meet::ENTRY_APP_MEET_MANAGER_CSV:
				return new TeamExport($meet->id);

			case Meet::ENTRY_APP_SWIMMING_CSV:
				return new UszasTeamExport($meet->id);

			default:
				return back();
		}
    }

    /**
     * @param Meet $meet
     * @return \Illuminate\Http\Response
     */
    public function entries(Meet $meet)
    {
		switch($meet->entry_app) {
			case Meet::ENTRY_APP_MEET_MANAGER_CSV:
				return new EntryExport($meet->id);

			case Meet::ENTRY_APP_SWIMMING_CSV:
				return new UszasEntryExport($meet->id);

			default:
				return back();
		}
    }
}
