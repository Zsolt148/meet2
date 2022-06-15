<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Competitor;
use App\Models\MeetEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EntryTimeController extends Controller
{
	/**
	 * Handle the incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function __invoke(Request $request, $meetId, $competitorId, $meetEventId)
	{
		$competitor = Competitor::query()->find($competitorId);
		$meetEvent = MeetEvent::query()->findOrFail($meetEventId);
		$eventShort = eventShortener($meetEvent->event);

		if(Storage::disk('times')->exists('ered50.dat')) {

			$matches = [];
			$file = storage_path('app/times/ered50.dat');
			$handle = fopen($file, "r");

			while(!feof($handle)) {
				$buffer = utf8_encode(fgets($handle));
				$name = trim(substr($buffer, 25, 30));
				//$birth = substr($buffer, 56, 4); // TODO fix me

				$be_tav = trim(substr($buffer, 0, 8));
				$be_vn = trim(substr($buffer, 8, 1));
				$be_un = trim(substr($buffer, 9, 1));
				$event = $be_tav . $be_vn . $be_un;

				// event and name matches
				// TODO check birht year too
				if(
					Str::contains($event, $eventShort) && Str::contains($name, $competitor->name)
				) {
					//$korcsop = trim(substr($buffer, 10, 2)); not needed
					$time = trim(substr($buffer, 12, 8));
					$be_datum = trim(substr($buffer, 106, 8));

					$matches[] = [
						'event' => $event,
						'time' => [
							'full' => $time,
							'min' => explode(':', $time)[0],
							'sec' => explode(',', explode(':', $time)[1])[0],
							'milli' => explode(',', $time)[1],
						],
						'date' => $be_datum
					];
				}
			}

			fclose($handle);

			//dd($matches);

			return response()->json(last($matches));
		}

		return response()->json();
	}
}
