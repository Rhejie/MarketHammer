<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Events;

class EventController extends Controller
{
    public $service;

    public function __construct()
    {
        $this->service = new \App\Service\Events\EventService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businessList = \App\Model\BusinessList::where('deleted_at', null)
        ->select(['id AS value', 'businessName AS label'])
        ->get()->toArray();

        return view('backoffice/event/index', [
            'businessList' => $businessList
        ]);
    }

    public function getEvents(Request $request)
    {
        $searchString = $request->input('searchString');
        $isActive = $request->input('isActive');
        $business = $request->input('business');
        $daterange = $request->input('daterange');

        $events = Events::with(['business' => function ($q) {
            $q->select(['id', 'businessName']);
        }, 'eventMedias' => function ($q) {
            $q->select(['*', \DB::raw('false AS is_deleted')]);
        }]);
       
        if ($searchString) {
            $events->where(function($q) use ($searchString) {
                $q->where('name', 'like', "%$searchString%");
                $q->orWhere('link', 'like', "%$searchString%");
                $q->orWhere('address', 'like', "%$searchString%");
            });
        }

        if ($isActive != null) {
            $events->where('is_active', $isActive);
        }

        if ($business) {
            $events->where('businessListID', $business);
        }

        if ($daterange) {
            $dates = ['start' => $daterange[0], 'end' => $daterange[1]];
            $events->betweenDates($dates);
        }

        $events = $events->paginate($request->input('size'));

        return ['success' => true, 'data' => $events];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes['name'] = $request->input('name');
        $attributes['startDate'] = $request->input('startDate');
        $attributes['endDate'] = $request->input('endDate');
        $attributes['is_active'] = $request->input('is_active');
        $attributes['link'] = $request->input('link');

        \DB::beginTransaction();
        try {
            $model = new Events;
            $model->fill($attributes);
            $model->businessListID = $request->input('businessListID');
            $model->created_at = auth()->user()->utcTimeNow();

            if (!$model->validate()) return ['success' => false, 'errors' => $model->errors];

            $success = $model->save();

            if ($success) {
                if ($request->hasFile('medias')) {
                    $files = $this->service->saveFiles($request->file('medias'), $model->id);
                    $eventMedias = $this->service->saveEventMedias($files, $model->id);

                    if (!$eventMedias['success']) return $eventMedias['errors'];
                }

                \DB::commit();

                $model->loadMissing(['business' => function ($q) {
                        $q->select(['id', 'businessName']);
                }, 'eventMedias' => function ($q) {
                    $q->select(['*', \DB::raw('false AS is_deleted')]);
                }]);

                return ['success' => true, 'data' => $model];
            }

            return ['success' => false];
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attributes['name'] = $request->input('name');
        $attributes['startDate'] = $request->input('startDate');
        $attributes['endDate'] = $request->input('endDate');
        $attributes['is_active'] = $request->input('is_active');
        $attributes['link'] = $request->input('link');

        $model = Events::find($id);
        if ($model) {
            \DB::beginTransaction();
            try {
                $model->fill($attributes);
                $model->businessListID = $request->input('businessListID');
                $model->updated_at = auth()->user()->utcTimeNow();

                if (!$model->validate()) return ['success' => false, 'errors' => $model->errors];

                $success = $model->save();

                if ($success) {
                    if ($request->hasFile('medias')) {
                        $files = $this->service->saveFiles($request->file('medias'), $model->id);
                        $eventMedias = $this->service->saveEventMedias($files, $model->id);

                        if (!$eventMedias['success']) return $eventMedias['errors'];
                    }

                    if ($request->input('eventMedia')) {
                        $deletedMedias = array_values(array_filter($request->input('eventMedia'), function ($q) {
                            return $q['is_deleted'] == 1;
                        }));

                        $eventMedias = $this->service->deleteEventMedias($deletedMedias);
                    }

                    \DB::commit();
                    $model->loadMissing(['business' => function ($q) {
                        $q->select(['id', 'businessName']);
                    }, 'eventMedias' => function ($q) {
                        $q->select(['*', \DB::raw('false AS is_deleted')]);
                    }]);

                    return ['success' => true, 'data' => $model];
                }

                return ['success' => false];
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return ['success' => false, 'code' => 'no_model_found'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Events::find($id);

        if ($model) {
            \DB::beginTransaction();
            try {
                $success = $model->delete();

                if ($success) {
                    \DB::commit();

                    return ['success' => true, 'data' => $id];
                }

                return ['success' => false];
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return ['success' => false, 'code' => 'no_model_found'];
    }
}
