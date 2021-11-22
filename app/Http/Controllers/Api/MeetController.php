<?php

namespace App\Http\Controllers\Api;

use App\Models\Meet;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MeetController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param $meetId
     * @param null $method
     * @param null $param
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, $meetId, $method = null, $param = null)
    {
        $meet = Meet::findOrFail($meetId);

        // directory
        $dir = meetDir($meet) . '/htmls';
        if (!file_exists($dir)) {
            return response()->json(['msg' => 'Meet directory not found', 'dir' => $dir], 500);
        }

        //Fájlok a mappába
        $files = array_slice(scandir($dir), 2);
        if (empty($files)) {
            return response()->json(['msg' => 'Meet directory is empty', 'files' => $files], 500);
        }

        switch ($method) {

            case 'getSectionsGroupBy':

                $evtindex = utf8_encode(file_get_contents($dir . '/evtindex.htm'));

                if (Str::contains($evtindex, 'Szakasz')) {
                    $sessions = explode('Szakasz', $evtindex);
                }elseif(Str::contains($evtindex, 'Session')) {
                    $sessions = explode('Session', $evtindex);
                }

                $sections = array();
                for($i = 0; $i < $meet->phases; $i++){
                    $sections[] = [
                        'id' => $i + 1,
                        'name' => $this->getDay($sessions[$i+1]) . ' - ' . $this->getHour($sessions[$i+1]),
                    ];
                }

                return response()->json($sections, 200);

                break;

            //Szakasz valasztas az evtindex alapjan
            //evtindex.htm bol szedi ki hogy melyik szakaszba melyik versenyszam van
            case 'getSections':
                $sections = array();

                $evtindex = utf8_encode(file_get_contents($dir . '/evtindex.htm'));
                $subdate = substr(str_replace('.', '', explode(' ', $meet->date)[0]), 2); //pl. 191019

                //Fájlok a mappába -> $value = nevek
                foreach ($files as $key => $value) {

                    // File name check from date
                    if (!Str::contains($value, $subdate)) {
                        continue;
                    }

                    if (Str::contains($evtindex, 'Szakasz')) {
                        //Végig a szakaszokon
                        foreach(explode('Szakasz', $evtindex) as $session) {
                            // Ha abba a szakaszba van amit kiválasztott
                            // es a fajl benne van az adott sessionbe
                            if ($this->getSectionId($session) == $param && Str::contains($session, $value)) {
                                $sections[] = [
                                    'name' => $this->getSectionName($session, $value),
                                    'file' => $value
                                ];
                            }
                        }
                    }
                    elseif (Str::contains($evtindex, 'Session')) {
                        foreach(explode('Session', $evtindex) as $session) {
                            if ($this->getSectionId($session) == $param && Str::contains($session, $value)) {
                                $sections[] = [
                                    'name' => $this->getSectionName($session, $value),
                                    'file' => $value
                                ];
                            }
                        }
                    }
                }

                return response()->json($sections, 200);
                break;

            case 'getStartlist': // Rajtlistak lekerdezese rajtlista / startlist
                $startlists = array();

                foreach ($files as $key => $value) {
                    //Ha .htm kiterjesztett és benne van a rajtlista vagy a startlist szó
                    if (
                        Str::contains($value, '.htm') &&
                        (stripos($value, "rajtlista") !== false || stripos($value, "startlist") !== false)
                    ) {
                        $startlists[] = [
                            'name' => Str::replaceLast('.htm', '', $value),
                            'file' => $value
                        ];
                    }
                }

                return response()->json($startlists, 200);
                break;

            case 'getStartlistSession': //Szakasz rajtlista MeetProg S1.htm vagy meetprog
                $startlistSession = array();

                foreach ($files as $key => $value) {
                    if(Str::contains($value, '.htm')) {
                        if(stripos($value, 'meetprogs') !== false) {
                            $name = stristr($value, 'meetprogs');
                            if(stripos($name, $param) !==false ) {
                                $startlistSession[] = array('name' => $name, 'file' => $value);
                            }
                        }

                    }
                }

                return response()->json(['content' => $startlistSession]);
                break;

            case 'getResults': //Eredmenyek lekerdezese Results v1 vagy results
                $results = array();

                foreach($files as $key => $value) {
                    if(strpos($value, '.htm') !==false && stripos($value, 'results') !== false) {
                        $name = stristr($value, 'results');
                        $name = str_replace('.htm', '', $name);
                        $results[] = array('name' => $name, 'file' =>$value);
                    }
                }

                if(count($results) > 1 ) {
                    return response()->json(['content' => $results, 'select' => true]);
                }else {
                    return response()->json(['content' => $results]);
                }

                break;

            case 'getSchedule':
                $sc = array();
                $names = array();
                $return = array();

                foreach($files as $key => $value) {
                    if(Str::contains($value, '.htm') && (stripos($value, 'idoterv') !==false || stripos($value, 'schedule') !== false))  {
                        //$sc[] = array('name' => 'Time Schedule', 'file' => $value);
                        array_push($sc, filemtime($dir.'/'.$value));
                        array_push($names, $value);
                    }

                }

                if(!empty($names)) {
                    array_multisort($sc, $names);
                    $fname = array_reverse($names);
                    $return = array('name' => 'Time Schedule', 'file' => $fname[0]);
                }

                return response()->json(['content' => $return]);

                break;

            case 'getSummary': //Öszsesítés
                $summary = array();

                foreach($files as $key => $value) {
                    if(Str::contains($value, '.htm')) {
                        if(stripos($value, 'csapat_pontverseny') !==false ) {
                            $summary[] = array('name' => 'Csapat pontverseny', 'file' => $value);
                        }
                        if(stripos($value, 'ferfi_egyeni_pontverseny') !== false) {
                            $summary[] = array('name' => 'Férfi egyéni pontverseny', 'file' => $value);
                        }
                        if(stripos($value, 'noi_egyeni_pontverseny') !== false) {
                            $summary[] = array('name' => 'Női egyéni pontverseny', 'file' => $value);
                        }
                        if(stripos($value, 'eremtablazat') !== false) {
                            $summary[] = array('name' => 'Éremtáblázat', 'file' => $value);
                        }
                        if(stripos($value, 'ferfi_abszolut') !== false) {
                            $summary[] = array('name' => 'Férfi abszolút pontverseny', 'file' => $value);
                        }
                        if(stripos($value, 'noi_abszolut') !== false) {
                            $summary[] = array('name' => 'Női abszolút pontverseny', 'file' => $value);
                        }

                    }
                }

                return response()->json(['content' => $summary]);
                break;

            case 'getFileContent':
                //Fájl kiválasztása a legördülő listából
                $file = $this->replaceForeignChar(utf8_encode(file_get_contents($dir . '/' . $param)));

                //Ha .htm fájl akkor darabol
                if(strpos($param, '.htm') !== false) {

                    //Első sornyi cím leszedése
                    if (Str::contains($file, '<b>')) {
                        $file = explode("<b>", $file, 2)[1]; //Cím leszedése
                        $withTags = '<pre><b>' . $file;
                        $file = str_replace("<b>", "</div><div><b>", $withTags); //Kereső tag -ek
                    }

                    //Ha nincs benne b tag es van benne input & body tag
                    if(!Str::contains($file, '<b>') && stripos($file, 'input') !== false && stripos($file, '<body>')) {
                        $file = explode('<body>', $file, 2)[1];
                    }
                }

                $file = str_replace("=", " ", $file);

                sleep(1);
                return response()->json($file, 200);
                break;


            default:
                return response()->json(['messages' => 'No controlling method found!'], 500);
                break;
        }
    }

    /**
     * @param $session
     * @return false|string
     */
    private function getSectionId($session) {
        $firstRow = strtok($session, '\n'); //Szakasz első sora
        $str = str_replace(' ', '', $firstRow); //Space ki
        return substr($str, 0, strspn($str, '0123456789')); //Csak a ahanyadik szakasz
    }

    /**
     * @param $session
     * @param $value
     * @return string
     */
    private function getSectionName($session, $value) {
        $loc = strpos($session, $value); //A fájl nevének a poziciója a stringben
        $hash = strpos($session, '#', $loc); //A hashteg poziciója a stringben a fájl nevétől nézve
        $closetag = strpos($session, '</a>', $hash); // A zárótag poziciója a hastől nézve
        $name = substr($session, $hash, $closetag - $hash); //A hashtől egészen a zárótegig

        return $this->replaceForeignChar($name);
    }

    /**
     * @param $name
     * @return string
     */
    private function replaceForeignChar($name) {
        return str_ireplace('õ', 'ő', str_ireplace('û', 'ű', $name));
    }

    /**
     * @param $search
     * @return false|string
     */
    private function getHour($search) {

        if(Str::contains($search, 'AM')) {
            $loc = strpos($search, 'AM');
        }elseif(Str::contains($search, 'PM')) {
            $loc = strpos($search, 'PM');
        }

        return substr($search, $loc - 6, 8);
    }

    /**
     * @param $search
     * @return string
     */
    private function getDay($search) {
        if(app()->getLocale() == "hu") {
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
        } else {
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
    }
}
