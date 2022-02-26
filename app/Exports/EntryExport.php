<?php

namespace App\Exports;

use App\Models\Competitor;
use App\Models\Entry;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;

class EntryExport extends StringValueBinder implements FromQuery, Responsable, WithCustomCsvSettings, WithHeadings, WithMapping, WithCustomValueBinder
{
    use Exportable;

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'Entry.csv';

    /**
     * Optional Writer Type
     */
    private $writerType = Excel::CSV;

    /**
     * Optional headers
     */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    /**
     * @var int $meetId
     */
    private $meetId;

    /**
     * CompetitorExport constructor.
     * @param int $meetId
     */
    public function __construct(int $meetId)
    {
        $this->meetId = $meetId;
    }

    /**
     * @return array
     */
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';',
            'use_bom' => false,
            //'output_encoding' => 'ISO-8859-1',
        ];
    }

//    /**
//     * @return array
//     */
//    public function columnFormats(): array
//    {
//        return [
//            'D' => NumberFormat::FORMAT_TEXT,
//            'F' => NumberFormat::FORMAT_TEXT,
//        ];
//    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Entry::query()
            ->whereMeetId($this->meetId)
            ->with('competitor', 'meetEvent');
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'Event_ptr',
            'Ath_no',
            'ActSeed_course',
            'ActualSeed_time',
            'ConvSeed_course',
            'ConvSeed_time',
            'Scr_stat',
            'Spec_stat',
            'Dec_stat',
            'Alt_stat',
            'Bonus_event',
            'Div_no',
            'Ev_score',
            'JDEv_score',
            'Seed_place',
            'event_age',
            'Pre_heat',
            'Pre_lane',
            'Pre_stat',
            'Pre_Time',
            'Pre_course',
            'Pre_heatplace',
            'Pre_place',
            'Pre_jdplace',
            'Pre_exh',
            'Pre_points',
            'Pre_back1',
            'Pre_back2',
            'Pre_back3',
            'Pre_watch1',
            'Pre_pad',
            'Pre_reactiontime1',
            'Pre_dqcode',
            'Pre_dqcodeSecond',
            'Pre_TimeType',
            'Fin_heat',
            'Fin_lane',
            'Fin_stat',
            'Fin_Time',
            'Fin_course',
            'Fin_heatplace',
            'Fin_jdheatplace',
            'Fin_place',
            'Fin_jdplace',
            'Fin_exh',
            'Fin_points',
            'Fin_back1',
            'Fin_back2',
            'Fin_back3',
            'Fin_watch1',
            'Fin_pad',
            'Fin_reactiontime1',
            'Fin_dqcode',
            'Fin_dqcodeSecond',
            'Fin_ptsplace',
            'fin_heatltr',
            'fin_TimeType',
            'Sem_heat',
            'Sem_lane',
            'Sem_stat',
            'Sem_Time',
            'Sem_course',
            'Sem_heatplace',
            'Sem_place',
            'Sem_jdplace',
            'Sem_exh',
            'Sem_points',
            'Sem_back1',
            'Sem_back2',
            'Sem_back3',
            'Sem_watch1',
            'Sem_pad',
            'Sem_reactiontime1',
            'Sem_dqcode',
            'Sem_dqcodeSecond',
            'Sem_TimeType',
            'dq_type',
            'Fin_group',
            'Fin_dolphin1',
            'Fin_dolphin2',
            'Fin_dolphin3',
            'Pre_dolphin1',
            'Pre_dolphin2',
            'Pre_dolphin3',
            'Sem_dolphin1',
            'Sem_dolphin2',
            'Sem_dolphin3',
            'early_seed',
            'super_prefinalist',
            'super_finfinalist',
            'fin_adjuststat',
            'pre_adjuststat',
            'sem_adjuststat',
            'fin_divingdd',
            'pre_divingdd',
            'sem_divingdd',
            'entry_method'
        ];

    }

    /**
     * @param Entry $entry
     * @return array
     */
    public function map($entry): array
    {
        $min = explode(':', $entry->time)[0];
        $secs = explode(':', explode('.', $entry->time)[0])[1]; // 00:28.32 - seconds from this format
        $milli = str_pad(explode('.', $entry->time)[1], 7, '0');
        $time = ($min * 60) + $secs . '.' . $milli; // Example: 276.0000000

        return [
            $entry->meet_event_id, //'Event_ptr', //TODO check if its the good id
            $entry->competitor->id, //'Ath_no',
            'L', //'ActSeed_course',
            $time, //'ActualSeed_time',
            'L', //'ConvSeed_course',
            $time, //'ConvSeed_time',
            'HAMIS', //'Scr_stat',
            '', //'Spec_stat',
            '', //'Dec_stat',
            'HAMIS', //'Alt_stat',
            'HAMIS', //'Bonus_event',
            '', //'Div_no',
            '', //'Ev_score',
            '', //'JDEv_score',
            '', //'Seed_place',
            '', //'event_age',
            '', //'Pre_heat',
            '', //'Pre_lane',
            '', //'Pre_stat',
            '', //'Pre_Time',
            '', //'Pre_course',
            '', //'Pre_heatplace',
            '', //'Pre_place',
            '', //'Pre_jdplace',
            '', //'Pre_exh',
            '', //'Pre_points',
            '', //'Pre_back1',
            '', //'Pre_back2',
            '', //'Pre_back3',
            '', //'Pre_watch1',
            '', //'Pre_pad',
            '', //'Pre_reactiontime1',
            '', //'Pre_dqcode',
            '', //'Pre_dqcodeSecond',
            '', //'Pre_TimeType',
            '', //'Fin_heat',
            '', //'Fin_lane',
            '', //'Fin_stat',
            '', //'Fin_Time',
            '', //'Fin_course',
            '', //'Fin_heatplace',
            '', //'Fin_jdheatplace',
            '', //'Fin_place',
            '', //'Fin_jdplace',
            '', //'Fin_exh',
            '', //'Fin_points',
            '', //'Fin_back1',
            '', //'Fin_back2',
            '', //'Fin_back3',
            '', //'Fin_watch1',
            '', //'Fin_pad',
            '', //'Fin_reactiontime1',
            '', //'Fin_dqcode',
            '', //'Fin_dqcodeSecond',
            '', //'Fin_ptsplace',
            '', //'fin_heatltr',
            '', //'fin_TimeType',
            '', //'Sem_heat',
            '', //'Sem_lane',
            '', //'Sem_stat',
            '', //'Sem_Time',
            '', //'Sem_course',
            '', //'Sem_heatplace',
            '', //'Sem_place',
            '', //'Sem_jdplace',
            '', //'Sem_exh',
            '', //'Sem_points',
            '', //'Sem_back1',
            '', //'Sem_back2',
            '', //'Sem_back3',
            '', //'Sem_watch1',
            '', //'Sem_pad',
            '', //'Sem_reactiontime1',
            '', //'Sem_dqcode',
            '', //'Sem_dqcodeSecond',
            '', //'Sem_TimeType',
            '', //'dq_type',
            '', //'Fin_group',
            '', //'Fin_dolphin1',
            '', //'Fin_dolphin2',
            '', //'Fin_dolphin3',
            '', //'Pre_dolphin1',
            '', //'Pre_dolphin2',
            '', //'Pre_dolphin3',
            '', //'Sem_dolphin1',
            '', //'Sem_dolphin2',
            '', //'Sem_dolphin3',
            'HAMIS', //'early_seed',
            'HAMIS', //'super_prefinalist',
            'HAMIS', //'super_finfinalist',
            '', //'fin_adjuststat',
            '', //'pre_adjuststat',
            '', //'sem_adjuststat',
            '', //'fin_divingdd',
            '', //'pre_divingdd',
            '', //'sem_divingdd',
            '', //'entry_method'
        ];
    }
}
