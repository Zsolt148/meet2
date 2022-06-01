<?php

namespace App\Exports\Uszas;

use App\Models\Team;
use App\Traits\EntryTrait;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Excel;

class TeamExport implements FromQuery, Responsable, WithCustomCsvSettings, WithMapping
{
    use Exportable, EntryTrait;


	/**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'Egyesuletek.csv';

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
     * @param Team $team
     * @return array
     */
    public function map($team): array
    {
        return [
           	$team->name,
            '0',
            '',
            is_null($team->country) ? 'HUN' : $team->country,
        ];
    }
}
