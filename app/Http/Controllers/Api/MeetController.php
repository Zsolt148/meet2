<?php

namespace App\Http\Controllers\Api;

use App\Models\Meet;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MeetController extends Controller
{

    private $meet;

    private $dir;

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
        $this->meet = Meet::findOrFail($meetId);

        // directory
        $this->dir = meetDir($this->meet) . '/htmls';
        if (!file_exists($this->dir)) {
            return response()->json(['msg' => 'Meet directory not found', 'dir' => $this->dir], 500);
        }

        //Fájlok a mappába
        $files = array_slice(scandir($this->dir), 2);
        if (empty($files)) {
            return response()->json(['msg' => 'Meet directory is empty', 'files' => $files], 500);
        }

        switch ($method) {

            case 'getResultSections':

                return response()->json($this->getSectionNames(), 200);

            //Szakasz valasztas az evtindex alapjan
            //evtindex.htm bol szedi ki hogy melyik szakaszba melyik versenyszam van
            case 'getEventsByParam':
                $sections = array();

                $evtindex = utf8_encode(file_get_contents($this->dir . '/evtindex.htm'));
                $subdate = substr(str_replace('.', '', explode(' ', $this->meet->date)[0]), 2); //pl. 191019

                //Fájlok a mappába -> $value = nevek
                foreach ($files as $key => $value) {

                    // id name check from date
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
                                    'id' => $value
                                ];
                            }
                        }
                    }
                    elseif (Str::contains($evtindex, 'Session')) {
                        foreach(explode('Session', $evtindex) as $session) {
                            if ($this->getSectionId($session) == $param && Str::contains($session, $value)) {
                                $sections[] = [
                                    'name' => $this->getSectionName($session, $value),
                                    'id' => $value
                                ];
                            }
                        }
                    }
                }

                return response()->json($sections, 200);
                break;

            // Rajtlistak lekerdezese rajtlista / startlist
            case 'getStartlists':
                $startlists = array();

                foreach ($files as $key => $value) {
                    //Ha .htm kiterjesztett és benne van a rajtlista vagy a startlist szó
                    if (
                        Str::contains($value, '.htm') &&
                        (stripos($value, "rajtlista") !== false || stripos($value, "startlist") !== false)
                    ) {
                        $startlists[] = [
                            'name' => Str::replaceLast('.htm', '', $value),
                            'id' => $value
                        ];
                    }
                }

                return response()->json(array_reverse($startlists), 200);

            //Szakasz rajtlista MeetProg S1.htm vagy meetprog
            case 'getStartlistSections':

                return response()->json($this->getSectionNames(), 200);

            case 'getStartlistByParam':
                $startlistSession = array();

                foreach ($files as $key => $value) {
                    if(Str::contains($value, '.htm') && stripos($value, 'meetprogs') !== false) {
                        $name = stristr($value, 'meetprogs');
                        if(stripos($name, $param) !==false ) {
                            $startlistSession[] = [
                                'name' => $name,
                                'id' => $value
                            ];
                        }
                    }
                }

                return response()->json($startlistSession, 200);

            //Eredmenyek lekerdezese Results v1 vagy results
            case 'getResults':
                $results = array();

                foreach($files as $key => $value) {
                    if(strpos($value, '.htm') !==false && stripos($value, 'results') !== false) {
                        $name = stristr($value, 'results');
                        $name = str_replace('.htm', '', $name);
                        $results[] = [
                            'name' => $name,
                            'id' => $value
                        ];
                    }
                }

                return response()->json($results, 200);

            case 'getTimeSchedule':
                $sc = array();
                $names = array();
                $return = array();

                foreach($files as $key => $value) {
                    if(Str::contains($value, '.htm') && (stripos($value, 'idoterv') !==false || stripos($value, 'schedule') !== false))  {
                        //$sc[] = array('name' => 'Time Schedule', 'id' => $value);
                        array_push($sc, filemtime($this->dir.'/'.$value));
                        array_push($names, $value);
                    }
                }

                if(!empty($names)) {
                    array_multisort($sc, $names);
                    $fname = array_reverse($names);
                    $return = array('name' => 'Time Schedule', 'id' => $fname[0]);
                }

                return response()->json($return, 200);

            case 'getSummary': //Öszsesítés
                $summary = array();

                foreach($files as $key => $value) {
                    if(stripos($value, 'csapat_pontverseny') !==false ) {
                        $summary[] = ['name' => __('Team points race'), 'id' => $value];
                    }
                    if(stripos($value, 'ferfi_egyeni_pontverseny') !== false) {
                        $summary[] = ['name' => 'Férfi egyéni pontverseny', 'id' => $value];
                    }
                    if(stripos($value, 'noi_egyeni_pontverseny') !== false) {
                        $summary[] = ['name' => 'Női egyéni pontverseny', 'id' => $value];
                    }
                    if(stripos($value, 'eremtablazat') !== false) {
                        $summary[] = ['name' => 'Éremtáblázat', 'id' => $value];
                    }
                    if(stripos($value, 'ferfi_abszolut') !== false) {
                        $summary[] = ['name' => 'Férfi abszolút pontverseny', 'id' => $value];
                    }
                    if(stripos($value, 'noi_abszolut') !== false) {
                        $summary[] = ['name' => 'Női abszolút pontverseny', 'id' => $value];
                    }
                }

                return response()->json($summary, 200);

            case 'getFileContent':
                //Fájl kiválasztása a legördülő listából
                $file = $this->replaceForeignChar(utf8_encode(file_get_contents($this->dir . '/' . $param)));

                //Ha .htm fájl akkor darabol
                if(Str::contains($param, '.htm')) {

                    //Első sornyi cím leszedése
                    if (Str::contains($file, '<b>')) {
                        $file = explode("<b>", $file, 2)[1]; //Cím leszedése
                        $withTags = '<pre><b>' . $file;
                        $file = str_replace("<b>", "</div><div><b>", $withTags); //Kereső tag -ek
                    }

                    //Div ezés a kereséshez
                    if (strpos($file, "Versenyszám") !== false) {
                        $file = str_replace("Versenyszám", "</div><div>Versenyszám", $file);
                    }elseif (strpos($file, "Event") !== false) {
                        $file = str_replace("Event", "</div><div>Event", $file);
                    }

                    //Ha nincs benne b tag es van benne input & body tag
                    if(!Str::contains($file, '<b>') && stripos($file, 'input') !== false && stripos($file, '<body>')) {
                        $file = explode('<body>', $file, 2)[1];
                    }
                }

                if(Str::contains($param, '.html') && Str::contains($file, 'BODY')) {
                    $file = file_get_contents($this->dir . '/' . $param);
                    //$file = explode('BODY', $file, 2)[1];
                }

                $file = str_replace("=", " ", $file);

                return response()->json($file, 200);

            default:
                return response()->json(['messages' => 'No controlling method found!'], 500);
        }
    }

    /**
     * @return array
     */
    private function getSectionNames(): array
    {
        $sections = [];
        $evtindex = utf8_encode(file_get_contents($this->dir . '/evtindex.htm'));

        if (Str::contains($evtindex, 'Szakasz')) {
            $sessions = explode('Szakasz', $evtindex);
        }elseif(Str::contains($evtindex, 'Session')) {
            $sessions = explode('Session', $evtindex);
        }

        for($i = 0; $i < $this->meet->phases; $i++){
            $sections[] = [
                'id' => $i + 1,
                'name' => $this->getDay($sessions[$i+1]) . ' - ' . $this->getHour($sessions[$i+1]),
            ];
        }

        return $sections;
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
