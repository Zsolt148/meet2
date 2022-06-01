<?php

namespace App\Exports\Uszas;

use App\Models\Entry;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;

class EntryExport extends StringValueBinder implements FromQuery, Responsable, WithCustomCsvSettings, WithMapping, WithCustomValueBinder
{
    use Exportable;

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'Nevezesek.csv';

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
        ];
    }

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
     * @param Entry $entry
     * @return array
     */
    public function map($entry): array
    {
        $time = $entry->min . ':' . $entry->sec . ',' . $entry->milli;

        return [
			$entry->competitor->name,
			'',
			$entry->meetEvent->order,
			$time,
			'',
			'',
			$entry->competitor->team->name,
			'0',
			'0',
			$entry->competitor->birth,
			$entry->competitor->birth,
			'1',
			'0',
			'',
			'0',
        ];
    }
}
