<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Meet;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home()
    {
        $meets = Meet::query()
            ->visible()
            ->with('location')
            ->latest()
            ->limit(5)
            ->get()
            ->mapWithKeys(function ($meet) {
                $meet->latestNews = $meet->latestNews();

                return [
                    $meet->id => $meet
                ];
            });

        return Inertia::render('Site/SiteHome', [
            'meets' => $meets
        ]);
    }
}
