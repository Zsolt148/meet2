<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Meet;
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
            ->visible()
            ->entriable();

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

        return Inertia::render('Portal/Meets/MeetsIndex', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'meets' => $query->paginate()->withQueryString(),
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
        // if not admin
        // abort if not visible or not entriable
        if(!auth()->user()->isAdmin()) {
            abort_if(!$meet->is_visible || !$meet->is_entriable, 404);
        }

        $meet->load('location', 'contact');
        $meet = $meet->getMediaFiles();
        $meet->latestNews = $meet->latestNews();

        return Inertia::render('Portal/Meets/MeetsShow', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'meet' => $meet
        ]);
    }
}
