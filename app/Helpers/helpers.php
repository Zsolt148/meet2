<?php

use App\Models\Meet;
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
    return storage_path('app/meets/' . meetFolderName($meet));
}

/**
 * @param Meet $meet
 * @return string|string[]
 */
function meetFolderName(Meet $meet) {
    $date = Str::ascii(explode(" ", $meet->date)[0]);
    $name = Str::ascii(explode(" ", $meet->name)[0]);
    return str_replace(".", "_", $date) . "_" . $name; //2019_10_22_Mercedes
}

/**
 * Adding day beaucuse of timezone at datepicker
 * @param array $dates
 * @return string
 */
function meetDate(array $dates) {
    return Carbon::create($dates[0])->addDay()->format('Y.m.d') . ' - ' . Carbon::create($dates[1])->addDay()->format('Y.m.d');
}