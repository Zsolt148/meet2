<?php

namespace App\Exports;

use App\Models\Team;
use App\Models\Entry;
use App\Traits\EntryTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Excel;

class TeamExport implements FromQuery, Responsable, WithCustomCsvSettings, WithHeadings, WithMapping
{
    use Exportable, EntryTrait;


	/**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'Team.csv';

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
	private $teamIds;

    /**
     * TeamExport constructor.
     */
    public function __construct($meetId)
    {
        $this->meetId = $meetId;
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
        return Team::query()
            ->whereIn('id', $this->teamIds);
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'Team_no',
            'Team_name',
            'Team_short',
            'Team_abbr',
            'Team_stat',
            'Team_lsc',
            'Team_div',
            'Team_region',
            'Team_head',
            'Team_asst',
            'Team_addr1',
            'Team_addr2',
            'Team_city',
            'Team_prov',
            'Team_statenew',
            'Team_zip',
            'Team_cntry',
            'Team_daytele',
            'Team_evetele',
            'Team_faxtele',
            'Team_email',
            'Team_c3',
            'Team_c4',
            'Team_c5',
            'Team_c6',
            'Team_c7',
            'Team_c8',
            'Team_c9',
            'Team_c10',
            'Team_altabbr',
            'Team_NoPoints',
            'Team_Selected',
            'Team_altname',
            'InvitedTeam_AgencyID',
            'InvitedTeam_Email',
            'Invited_InviteCode',
            'InvitedEntry_status',
            'InvitedPayment_status',
            'Invited_notes',
            'Invited_GovBody',
            'Invited_Athletecount',
            'Invited_TeamID',
            'InvitedHas_notes',
            'InvitedLeague_name',
            'InvitedFile_status',
            'InvitedFile_importdatetime',
            'InvitedFile_TMuploaddatetime',
            'InvitedFile_source',
            'Invited_TeamEntryID'
        ];
    }

    /**
     * @param Team $team
     * @return array
     */
    public function map($team): array
    {
        return [
            $this->getTeamIndex($this->teamIds, $team->id), // Team_no
            $team->short, // Team_name - short name cuz max 30 chars
            $team->short, // 'Team_short',
			$team->meet_abbr, // 'Team_abbr',
            '', // 'Team_stat',
            '', // 'Team_lsc',
            '', // 'Team_div',
            '', // 'Team_region',
            '', // 'Team_head',
            '', // 'Team_asst',
            '', // 'Team_addr1',
            '', // 'Team_addr2',
            '', // 'Team_city',
            '', // 'Team_prov',
            '', // 'Team_statenew',
            '', // 'Team_zip',
            is_null($team->country) ? 'HUN' : $team->country, // 'Team_cntry',
            '', // 'Team_daytele',
            '', // 'Team_evetele',
            '', // 'Team_faxtele',
            '', // 'Team_email',
            '', // 'Team_c3',
            '', // 'Team_c4',
            '', //  'Team_c5',
            '', // 'Team_c6',
            '', // 'Team_c7',
            '', // 'Team_c8',
            '', // 'Team_c9',
            '', // 'Team_c10',
            '', // 'Team_altabbr',
            'HAMIS', // 'Team_NoPoints',
            'HAMIS', // 'Team_Selected',
            '', // 'Team_altname',
            '', // 'InvitedTeam_AgencyID',
            '', // 'InvitedTeam_Email',
            '', // 'Invited_InviteCode',
            '', // 'InvitedEntry_status',
            '', // 'InvitedPayment_status',
            '', // 'Invited_notes',
            '', // 'Invited_GovBody',
            '', // 'Invited_Athletecount',
            '', // 'Invited_TeamID',
            'HAMIS', // 'InvitedHas_notes',
            '', // 'InvitedLeague_name',
            '', // 'InvitedFile_status',
            '', // 'InvitedFile_importdatetime',
            '', // 'InvitedFile_TMuploaddatetime',
            '', // 'InvitedFile_source',
            '', // 'Invited_TeamEntryID'
        ];
    }
}
