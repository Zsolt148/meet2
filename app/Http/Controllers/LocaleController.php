<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocaleController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $language)
    {
    	if(in_array($language, ['hu', 'en'])) {

			session()->put('locale', $language);

			if(Auth::check()) {
				Auth::user()->update(['locale' => $language]);
			}
		}

		return redirect()->back();
    }
}
