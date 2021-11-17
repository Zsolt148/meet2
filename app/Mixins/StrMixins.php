<?php

namespace App\Mixins;
use Illuminate\Support\Str;
use Config;

class StrMixins 
{
    public function replace()
    {
        return function($f) {
            $f = str_ireplace('á', 'a', $f);
            $f = str_ireplace('Á', 'A', $f);
            $f = str_ireplace('é', 'e', $f);
            $f = str_ireplace('É', 'E', $f);
            $f = str_ireplace('í', 'i', $f);
            $f = str_ireplace('Í', 'I', $f);
            $f = str_ireplace('ü', 'u', $f);
            $f = str_ireplace('Ü', 'U', $f);
            $f = str_ireplace('ű', 'u', $f);
            $f = str_ireplace('Ű', 'U', $f);
            $f = str_ireplace('ú', 'u', $f);
            $f = str_ireplace('Ú', 'U', $f);
            $f = str_ireplace('ó', 'o', $f);
            $f = str_ireplace('Ó', 'O', $f);
            $f = str_ireplace('ö', 'o', $f);
            $f = str_ireplace('Ö', 'O', $f);
            $f = str_ireplace('ő', 'o', $f);
            $f = str_ireplace('Ő', 'O', $f);
            return $f;
        };
    }

    public function foldername()
    {
        return function($race) {
            $storagename = explode(" ", $race->name);
            $date = explode(" ", $race->date);

            $foldername = str_replace(".", "_", $date[0]) . "_" . $storagename[0]; //2019_10_22_Mercedes
            
            $foldername = Str::replace($foldername);

            return $foldername;
        };
    }

    public function dir()
    {
        return function($race) {
            $foldername = Str::foldername($race);
            $foldername = Str::replace($foldername);

            $dir = public_path('storage/' . $foldername);

            return $dir;
        };
    }

    public function hour()
    {
        return function($search) {
            if(Config::get('app.locale') == "hu") {
                if(strpos($search, "AM") !== false ) {
                    $loc = strpos($search, "AM");
                    return substr($search, $loc - 6, 8);
                }else if(strpos($search, "PM") !== false ) {
                    $loc = strpos($search, "PM");
                    return substr($search, $loc - 6, 8);
                }
            }
            if(Config::get('app.locale') == "en") {
                if(strpos($search, "AM") !== false ) {
                    $loc = strpos($search, "AM");
                    return substr($search, $loc - 6, 8);
                }else if(strpos($search, "PM") !== false ) {
                    $loc = strpos($search, "PM");
                    return substr($search, $loc - 6, 8);
                }
            }
        };
    }

    public function day()
    {
        return function($search) {
            if(Config::get('app.locale') == "hu") {
                if(stripos($search, "hétfő") !== false) return "Hétfő";
                if(stripos($search, "kedd") !== false) return "Kedd";
                if(stripos($search, "szerda") !== false) return "Szerda";
                if(stripos($search, "csütörtök") !== false) return "Csütörtök";
                if(stripos($search, "péntek") !== false) return "Péntek";
                if(stripos($search, "Szombat") !== false) return "Szombat";
                if(stripos($search, "vasárnap") !== false) return "Vasárnap";
                if(stripos($search, "monday") !== false) return "Hétfő";
                if(stripos($search, "tuesday") !== false) return "Kedd";
                if(stripos($search, "wednesday") !== false) return "Szerda";
                if(stripos($search, "thursday") !== false) return "Csütörtök";
                if(stripos($search, "friday") !== false) return "Péntek";
                if(stripos($search, "saturday") !== false) return "Szombat";
                if(stripos($search, "sunday") !== false) return "Vasárnap";
            }
            if(Config::get('app.locale') == "en") {
                if(stripos($search, "hétfő") !== false) return "Monday";
                if(stripos($search, "kedd") !== false) return "Tuesday";
                if(stripos($search, "szerda") !== false) return "Wednesday";
                if(stripos($search, "csütörtök") !== false) return "Thursday";
                if(stripos($search, "péntek") !== false) return "Friday";
                if(stripos($search, "Szombat") !== false) return "Saturday";
                if(stripos($search, "vasárnap") !== false) return "Sunday";
                if(stripos($search, "monday") !== false) return "Monday";
                if(stripos($search, "tuesday") !== false) return "Tuesday";
                if(stripos($search, "wednesday") !== false) return "Wednesday";
                if(stripos($search, "thursday") !== false) return "Thursday";
                if(stripos($search, "friday") !== false) return "Friday";
                if(stripos($search, "saturday") !== false) return "Saturday";
                if(stripos($search, "sunday") !== false) return "Sunday";
            }
        };
    }
}