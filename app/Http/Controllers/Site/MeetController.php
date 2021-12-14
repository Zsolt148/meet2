<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Meet;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class MeetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        request()->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,created_at'],
        ]);

        $query = Meet::query()
            ->with('location')
            ->visible();

        if($search = request('search')) {
            $query->where(function ($query) use ($search) {
                $query
                    ->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('host', 'LIKE', '%' . $search . '%')
                    ->orWhere('date', 'LIKE', '%' . $search . '%');
            });
        }

        if($year = request('year')) {
            $query->where('date', 'LIKE', '%'.$year.'%');
        }

        if(request()->has(['field', 'direction'])) {
            $query->orderBy(request('field'), request('direction'));
        }else {
            $query->latest();
        }

        for($i = 0; $i < 8; $i++) {
            $years[] = Carbon::now()->subYear($i)->format('Y');
        }

        return Inertia::render('Site/Meets/MeetsIndex', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'meets' => $query->paginate()->withQueryString(),
            'years' => $years,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function show(Meet $meet)
    {
        // if not logged in and not admin
        // abort if not visible
        if(!auth()->user() || !auth()->user()->isAdmin()) {
            abort_if(!$meet->is_visible, 404);
        }

        $meet->load('location', 'contact');
        $meet = $meet->getMediaFiles();
        $meet->latestNews = $meet->latestNews();

        return Inertia::render('Site/Meets/MeetsShow', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'meet' => $meet
        ]);
    }
}
