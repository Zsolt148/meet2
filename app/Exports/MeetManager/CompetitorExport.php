<?php

namespace App\Exports\MeetManager;

use App\Models\Competitor;
use App\Traits\EntryTrait;
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

class CompetitorExport extends StringValueBinder implements FromQuery, Responsable, WithCustomCsvSettings, WithHeadings, WithMapping, WithCustomValueBinder
{
    use Exportable, EntryTrait;

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'Atlhete.csv';

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
	 * @var array
	 */
    private $competitorIds;

	/**
	 * @var array
	 */
	private $teamIds;

    /**
     * CompetitorExport constructor.
     * @param int $meetId
     */
    public function __construct(int $meetId)
    {
        $this->meetId = $meetId;
		$this->competitorIds = $this->getCompetitorIdsByMeet($meetId);
		$this->teamIds = $this->getTeamIdsByMeet($meetId);
	}

    /**
     * @return array
     */
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';',
            'use_bom' => false,
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Competitor::query()
			->whereHas('entries', function ($query) {
				$query->whereMeetId($this->meetId);
			});
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'Ath_no',
            'Last_name',
            'First_name',
            'Initial',
            'Ath_Sex',
            'Birth_date',
            'Team_no',
            'Schl_yr',
            'Ath_age',
            'Reg_no',
            'Ath_stat',
            'Div_no',
            'Comp_no',
            'Pref_name',
            'Home_addr1',
            'Home_addr2',
            'Home_city',
            'Home_prov',
            'Home_statenew',
            'Home_zip',
            'Home_cntry',
            'Home_daytele',
            'Home_evetele',
            'Home_faxtele',
            'Home_email',
            'Citizen_of',
            'Picture_bmp',
            'second_club',
            'Home_celltele',
            'bcssa_type',
            'Home_emergcontact',
            'Home_emergtele',
            'Disab_Scode',
            'Disab_SBcode',
            'Disab_SMcode',
            'Disab_SDMSID',
            'Disab_Exeptioncodes'
        ];
    }

    /**
     * @param Competitor $comp
     * @return array
     */
    public function map($comp): array
    {
        $name = explode(' ', $comp->name, 2);
        $last_name = isset($name[0]) ? $name[0] : '';
        $first_name = isset($name[1]) ? $name[1] : '';

        return [
			$this->getCompetitorIndex($this->competitorIds, $comp->id),
            $last_name,
            $first_name,
            '',
            isset($comp->sex) ? ($comp->sex == 'N' ? 'F' : 'M') : '', // Nő - férfi => Female - Male
            Carbon::createFromFormat('Y', $comp->birth)->startOfYear()->format('Y.m.d'),
			$this->getTeamIndex($this->teamIds, $comp->team_id),
            '', // Schl_yr
            Carbon::now()->format('Y') - $comp->birth,
            '', // Reg no
            '', // Ath_stat
            '', // Div no
			$this->getCompetitorIndex($this->competitorIds, $comp->id), // Comp_no
			'', // pref name
            '', // home addr1
            '', // home addr2
            '', // home city
            '', // home prov
            '', // home statenew
            '', // home zip
            '', // home cntry
            '', // home daytele
            '', // home evetele
            '', // home faxtele
            '', // home email
            '', // citizen of
            '', // picture bmp
            '', // second club
            '', // home celltele
            '', // bcssa_type
            '', // home emergcontact
            '', // home emergtele
            '0', // disab_Scode
            '0', // disac_sbcode
            '0', // disab smcode
            '', // disab sdmsid
            '', // disab exceptioncodes
        ];
    }
}
