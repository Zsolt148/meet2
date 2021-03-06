<?php

use App\Models\Event;
use App\Models\Meet;
use App\Models\MeetEvent;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @param $json
 * @return array|mixed
 */
function translations($json)
{
    if(!file_exists($json)) {
        return [];
    }
    return json_decode(file_get_contents($json), true);
}

/**
 * @param Meet $meet
 * @return string
 */
function meetDir(Meet $meet) {
    return storage_path('app/meets/' . $meet->folder);
}

/**
 * @param Meet $meet
 * @return string|string[]
 */
function meetFolderName(Meet $meet) {
    $date = Str::ascii(explode(" ", $meet->date)[0]);
    return Str::slug(str_replace(".", "-", $date) . '-' . Str::ascii($meet->name));
    //return str_replace(".", "_", $date) . "_" . $name; //2019_10_22_Mercedes - DEPRACETED
}

/**
 * Adding day beaucuse of timezone at datepicker
 * @param array $dates
 * @return string
 */
function meetDate(array $dates) {
    return Carbon::create($dates[0])->format('Y.m.d') . ' - ' . Carbon::create($dates[1])->format('Y.m.d');
}

/**
 * Text helper
 * @param MeetEvent $meetEvent
 * @return string
 */
function meetEvent(MeetEvent $meetEvent) {
    return $meetEvent->event->length . 'm ' . __($meetEvent->event->sex) . ' ' . __($meetEvent->event->swim) . ' ' . $meetEvent->category;
}

/**
 * @param Event $event
 * @return string
 */
function eventShortener(Event $event) {
	$sex = $event->sex == 'male' ? 'f' : 'n';
	switch($event->swim) {
		case 'butterfly':
			$swim = 'p';
			break;
		case 'backstroke':
			$swim = 'h';
			break;
		case 'freestyle':
			$swim = 'g';
			break;
		case 'breaststroke':
			$swim = 'm';
			break;
		case 'medley':
			$swim = 'v';
	}

	return $event->length . $sex . $swim;
}