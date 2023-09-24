<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\MeetRequest;
use App\Http\Resources\MediaResource;
use App\Http\Resources\MediaResourceCollection;
use App\Models\Contact;
use App\Models\Location;
use App\Models\Meet;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Media;

class MeetController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = $this->getQuery(Meet::class, request(), ['name', 'host', 'type', 'date']);

        if($year = request('year')) {
            $query->where('date', 'LIKE', '%'.$year.'%');
        }

        for($i = 0; $i < 8; $i++) {
            $years[] = Carbon::now()->subYear($i)->format('Y');
        }

        return Inertia::render('Admin/Meets/MeetsIndex', [
            'filters' => request()->all(['search', 'field', 'direction', 'year']),
            'meets' => $query->paginate()->withQueryString(),
            'years' => $years,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Meets/MeetsCreate', [
            'locations' => Location::all(),
            'contacts' => Contact::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MeetRequest $request)
    {
        $meet = new Meet();

        $meet->is_visible = $request->is_visible;
        $meet->name = $request->name;
        $meet->slug = $request->slug;
        $meet->folder = Str::ascii($request->slug);
        $meet->date = meetDate($request->date);
        $meet->deadline = $request->deadline;
        $meet->host = $request->host;
        $meet->type = $request->type;
        $meet->phases = $request->phases;
        $meet->location_id = $request->location_id;
        $meet->contact_id = $request->contact_id;

        $meet->save();

        if($body = $request->body) {
            $meet->news()->create([
                'body' => $body,
            ]);
        }

        $this->createMediaFiles($meet, $request->post('files'));

        return redirect()->route('admin:meets.edit', $meet)->with('success', 'Verseny sikeresen létrehozva');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function show(Meet $meet)
    {
        return redirect()->route('meets.show', $meet->slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function edit(Meet $meet)
    {
        $meet->load('news');
        $meet->latestNews = $meet->latestNews();
        $meet->mediaFiles = $meet->getMedia('files')
            ->collect()
            ->mapWithKeys(function ($media) {
                return [
                    $media->id => new MediaResource($media)
                ];
            });

        return Inertia::render('Admin/Meets/MeetsEdit', [
            'meet' => $meet,
            'locations' => Location::all(),
            'contacts' => Contact::all(),
            'isEntriable' => $meet->isEntriable()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function update(MeetRequest $request, Meet $meet)
    {
        $meet->fill($request->only(
            'is_visible',
            'is_entriable',
            //'name', TODO: meet dir rename
            'slug',
            'deadline',
            'host',
            'type',
            'phases',
            'location_id',
            'contact_id',
            'race_info_id',
            'pre_startlist_id',
            'race_record_id',
            'time_schedule_id'
        ));

        //$meet->date = meetDate($request->date); TODO: meet dir rename

        $meet->save();

        if($meet->latestNews()->body != $request->body) {
            $meet->news()->create([
                'body' => $request->body
            ]);
        }

        $this->createMediaFiles($meet, $request->post('files'));

        return redirect()->back()->with('success', 'Verseny sikeresen frissítve');
    }

    public function destroyMedia($mediaId)
    {
        $media = Media::findByUuid($mediaId);

        $meet = $media->model;

        if($media->raceInfo) {
            $meet->race_info_id = null;
        }

        if($media->preStartlist) {
            $meet->pre_startlist_id = null;
        }

        if($media->raceRecord) {
            $meet->race_record_id = null;
        }

        if($media->timeSchedule) {
            $meet->time_schedule_id = null;
        }

        $meet->save();
        $media->delete();

        return redirect()->back()->with('success', 'Fájl sikeresen törölve');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meet  $meet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meet $meet)
    {
        $meet->delete();

        return redirect()->route('admin:meets.index')->with('success', 'Verseny sikeresen frissítve');
    }

    /**
     * @param Meet $meet
     * @param $files
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    private function createMediaFiles(Meet $meet, $files)
    {
        foreach($files as $file) {
            if(Storage::disk('tmp')->exists($file['path'])) {
                $meet
                    ->addMedia(config('filesystems.disks.tmp.root') . $file['path'])
                    ->usingName($file['name'])
					->usingFileName($file['name'])
                    ->toMediaCollection('files');
            }
        }
    }
}
