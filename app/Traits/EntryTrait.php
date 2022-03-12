<?php

namespace App\Traits;

use App\Models\Competitor;
use App\Models\Entry;
use App\Models\Meet;
use App\Models\MeetEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

trait EntryTrait
{
    /**
     * @param Competitor $competitor
     * @param $entries
     * @return \Illuminate\Support\Collection
     */
    protected function getCompetitorForm(Competitor $competitor, Collection $entries)
    {
        return collect([
            'competitor_id' => $competitor->id,
            'is_final' => !$competitor->entries()->where('is_final', false)->exists(),
            'entries' => $entries->map(fn($entry) => [
                'id' => $entry->id,
                'meet_event_id' => $entry->meet_event_id,
                'time' => [
                    'min' => $entry->min,
                    'sec' => $entry->sec,
                    'milli' => $entry->milli,
                ],
                'is_final' => $entry->is_final,
                'is_paid' => $entry->is_paid,
                'created_at' => $entry->created_at,
                'updated_at' => $entry->updated_at,
            ])
        ]);
    }

    /**
     * @param Meet $meet
     * @return array
     */
    protected function getMeetEventsByGender(Meet $meet)
    {
        $query = MeetEvent::query()
            ->whereMeetId($meet->id)
            ->orderBy('order')
            ->with('event');

        $male = (clone $query)
            ->whereHas('event', function ($query) {
                $query->where('sex', 'male');
            })
            ->get();

        $female = (clone $query)
            ->whereHas('event', function ($query) {
                $query->where('sex', 'female');
            })
            ->get();

        $mix = (clone $query)
			->whereHas('event', function ($query) {
				$query->where('sex', 'mix');
			})
			->get();

        $male = $male->merge($mix);
		$female = $female->merge($mix);

        return [$male, $female];
    }

    /**
     * @param Meet $meet
     * @param Competitor $competitor
     * @return mixed
     */
    protected function getMeetEventsByCompetitor(Meet $meet, Competitor $competitor)
    {
        [$male, $female] = $this->getMeetEventsByGender($meet);

        return $competitor->sex == 'F' ? $male : $female;
    }


    /**
     * @param Request $request
     * @return bool
     * @throws ValidationException
     */
    protected function validateDuplicateEvents(Request $request)
    {
        // if the competitor already has the event
        // show validation error where the event is duplicated

        $array = array_column($request->input('entries'), 'meet_event_id');

        if(count(array_unique($array)) > count($array)) {
            return true;
        }

        if($duplicates = $this->getDuplicateEvents($array)) {
            $messages = [];

            foreach($duplicates as $key => $event_id) {
                $messages['entries.' . $key . '.meet_event_id'] = trans('validation.already_entered');
            }

            throw ValidationException::withMessages($messages);
        }
    }

    /**
     * @param array $array
     * @return array
     */
    protected function getDuplicateEvents(array $array = array())
    {
        return array_diff_key($array, array_unique($array));
    }

	/**
	 * @param $meetId
	 * @return array
	 */
    protected function getCompetitorIdsByMeet($meetId)
	{
		return Competitor::query()
			->whereHas('entries', function ($query) use ($meetId) {
				$query->whereMeetId($meetId);
			})
			->get()
			->pluck('id')
			->toArray();
	}

	/**
	 * @param $meetId
	 * @param $competitorId
	 * @return false|int|string
	 */
	protected function getCompetitorIndex($ids, $competitorId)
	{
		return array_search($competitorId, $ids) + 1;
	}

	/**
	 * @param $meetId
	 * @return array
	 */
	protected function getTeamIdsByMeet($meetId)
	{
		// unique team ids in the meet
		$teamIds = Entry::query()
				->whereMeetId($meetId)
				->with('competitor')
				->get()
				->pluck('competitor.team_id')
				->unique()
				->toArray();

		return array_values($teamIds);
	}

	/**
	 * @param $meetId
	 * @param $teamId
	 * @return false|int|string
	 */
	protected function getTeamIndex($ids, $teamId)
	{
		return array_search($teamId, $ids) + 1;
	}
}
