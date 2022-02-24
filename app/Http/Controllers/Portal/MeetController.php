<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Entry;
use App\Models\Meet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
        Gate::authorize('viewAny', Entry::class);

        request()->validate([
            'field' => ['in:name,created_at'],
        ]);

        $query = Meet::query()
            ->with('location')
            ->visible()
            ->entriable()
            ->latest();

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

        return Inertia::render('Portal/Meets/MeetsIndex', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'meets' => $query->paginate()->withQueryString(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Request           $request
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Meet $meet)
    {
        Gate::authorize('viewAny', Entry::class);

        // if not admin
        // abort if not visible or not entriable
        if(!auth()->user()->hasRole('admin')) {
            abort_if(!$meet->is_visible || !$meet->is_entriable, 404);
        }

        $request->validate([
            'direction' => ['in:asc,desc'],
            'field' => ['in:name,is_final,time,created_at'],
        ]);

        $query = auth()
            ->user()
            ->entries()
            ->whereMeetId($meet->id);

        $query->when(
            $search = $request->get('search'),
            fn(Builder $query) => $query
                // search competitor's name
                ->whereHas('competitor', function ($query) use ($search){
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
                case 'is_final':
                    $query->orderBy('is_final', $direction);
                    break;
                case 'time':
                    $query->orderBy('time', $direction);
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

        $meet->load('location', 'contact');
        $meet->loadMediaFiles();
        $meet->latestNews = $meet->latestNews();

        return Inertia::render('Portal/Meets/MeetsShow', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'meet' => $meet,
            'entries' => $query->paginate()->withQueryString(),
            'hasEntries' => auth()->user()->entries()->whereMeetId($meet->id)->get()->isNotEmpty()
        ]);
    }
}
