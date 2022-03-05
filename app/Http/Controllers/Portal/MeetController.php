<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Competitor;
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

        /* user's entries
        $query = auth()
            ->user()
            ->entries()
            ->whereMeetId($meet->id)
            ->whereHas('competitor', function ($query) {
                $query->where('team_id', auth()->user()->team_id);
            });
        */

        // team's entries
//        $query = Entry::query()
//            ->whereMeetId($meet->id)
//            ->with('competitor', 'meetEvent')
//            ->whereHas('competitor', function ($query) {
//                $query->where('team_id', auth()->user()->team_id);
//            })
//			->groupBy('competitors.name');

		// team's entries by competitors
		$query = Competitor::query()
			->whereTeamId(auth()->user()->team_id)
			->whereHas('entries', function ($query) use ($meet) {
				$query->whereMeetId($meet->id);
			})
			->withCount('entries')
			->with('entries');

//		dd($query->get());

        $entriesCount = $query->get()->sum('entries_count');
        $entriesAreFinal = (clone $query)
			->whereHas('entries', function ($query) {
				$query->where('is_final', false);
			})
			->get()
			->count() == 0;

        $query->when(
            $search = $request->get('search'),
            fn(Builder $query) => $query
				->where('name', 'like', '%' . $search . '%')
        );

        if($request->has(['field', 'direction'])) {
            $direction = $request->get('direction');
            switch($request->get('field')) {
                case 'name':
					$query->orderBy('name', $direction);
                    break;
            }
        }else {
			$query->orderByDesc('name');
		}

        $meet->load('location', 'contact');
        $meet->loadMediaFiles();
        $meet->latestNews = $meet->latestNews();

        $competitors = $query->get()->map(function (Competitor $competitor) use ($meet) {

        	$competitor->price = $competitor->entries_count * $meet->entry_price;
        	$competitor->is_final = $competitor->entries->where('is_final', false)->count() == 0;

        	return $competitor;
		});

        return Inertia::render('Portal/Meets/MeetsShow', [
            'filters' => request()->all(['search', 'field', 'direction']),
            'meet' => $meet,
            'competitors' => $competitors,
            'has_entries' => $entriesCount !== 0,
            'entries_count' => $entriesCount,
            'entries_are_final' => $entriesAreFinal,
        ]);
    }
}
