<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TwoFactorSetupController extends Controller
{
    public function setup()
    {
        return Inertia::render('Auth/SetupTwoFactor');
    }

    public function getSetupLink(Request $request)
    {
        // Csak ha már elindította a folyamatot (van secret), de még nincs megerősítve
        if (!$request->user()->two_factor_secret) {
            return response()->json(['url' => null]);
        }

        return response()->json([
            'url' => $request->user()->twoFactorQrCodeUrl()
        ]);
    }
}
