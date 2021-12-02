<?php

namespace App\Http\Controllers\BackOffice\Setting;

use Illuminate\Http\Request;
use App\Model\Setting\SnsList;
use App\Http\Controllers\Controller;
use App\Repositories\Sns\SnsRepository;
use App\Http\Requests\BackOffice\Sns\{StoreSnsList, UpdateSnsList};

class SnsController extends Controller
{
    /**
     * The abstraction layer for the translation module
     *
     * @var BusinessCertificationRepository
     */
    private $snsRepository;

    public function __construct(SnsRepository $snsRepository)
    {
        $this->snsRepository = $snsRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\BackOffice\Sns\StoreSnsList  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSnsList $request)
    {
        $translation = $this->snsRepository->create($request->all());
        $className = $this->resourceItem();

        return new $className($translation);
        /*\DB::beginTransaction();
        try {
            $translation = $this->snsRepository->create($request->all());

            if ($translation) {

                if ($this->hasTranslationData()) {
                    $this->storeFieldTranslations($translation);
                }
                \DB::commit();

                $className = $this->resourceItem();

                return new $className($translation);
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\BackOffice\Sns\StoreSnsList
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSnsList $request, $id)
    {
        //$model = SnsList::find($id);
        $translation = $this->snsRepository->update($request->all(), $id);
        $className = $this->resourceItem();

        return new $className($translation);

        /*if ($model) {
            \DB::beginTransaction();
            try {
                $translation = $this->snsRepository->update($request->all(), $id);

                if ($translation) {
                    \DB::commit();

                    $className = $this->resourceItem();

                    return new $className($translation);
                }
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sns = $this->snsRepository->delete($id);

        return $sns;
    }

    /**
     * This method will return the list of queried translations
     * This method will also apply search and pagination to the request
     *
     * @param $request <Illuminate\Http\Request>
     *
     * @return <array>
     */
    public function getSnsList(Request $request)
    {
        $searchString = $request->input('searchString');
        $status = $request->input('is_active');

        $snsList = SnsList::select();

        if ($searchString) {
            $snsList->where(function ($q) use ($searchString) {
                $q->where('name', 'like', "%$searchString%");
                $q->orWhere('description', 'like', "%$searchString%");
                $q->orWhere('website', 'like', "%$searchString%");
            });
        }

        $snsList = $snsList->with(['translations']);
        $snsList = $snsList->orderBy('id', 'DESC')->paginate($request->input('size'));

        return $snsList;
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\Sns\SnsListResource::class;
    }
}
