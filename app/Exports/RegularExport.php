<?php

namespace App\Exports;

use App\Models\Entry;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;

class RegularExport extends StringValueBinder implements FromQuery, Responsable, WithCustomCsvSettings, WithMapping, WithCustomValueBinder
{
	use Exportable;

	private $fileName = 'nevezesek.csv';

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
	 * @return Entry|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder
	 */
	public function query()
	{
		return Entry::query()
			->whereMeetId($this->meetId)
			->with('competitor', 'competitor.team', 'meetEvent', 'meetEvent.event');
	}

	/**
	 * @param $entry
	 * @return array
	 */
	public function map($entry): array
	{
		// reg.id, vezetéknév, keresztnév, szül.idő, nem,
		// nemzetiség, egyesület neve, vszam szorszám,
		// vszám megnevezése, nevezesi ido
		/** @var Entry $entry */

		return [
			$entry->id,
			$entry->competitor->name,
			$entry->competitor->birth,
			$entry->competitor->sex,
			$entry->competitor->team->country,
			$entry->competitor->team->name,
			$entry->meetEvent->order,
			$entry->meetEvent->event->name,
			$entry->min . ':' . $entry->sec . ',' . $entry->milli
		];
	}
}
