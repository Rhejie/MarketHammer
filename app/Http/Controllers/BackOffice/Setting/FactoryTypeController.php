<?php

namespace App\Http\Controllers\BackOffice\Setting;

use Illuminate\Http\Request;
use App\Model\Setting\FactoryType;
use App\Http\Controllers\Controller;
use App\Repositories\FactoryType\FactoryTypeRepository;
use App\Http\Requests\BackOffice\FactoryType\{StoreFactoryType, UpdateFactoryType};

class FactoryTypeController extends Controller
{
    /**
     * The abstraction layer for the translation module
     *
     * @var BusinessCertificationRepository
     */
    private $factoryTypeRepository;

    public function __construct(FactoryTypeRepository $factoryTypeRepository)
    {
        $this->factoryTypeRepository = $factoryTypeRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BackOffice\FactoryType\StoreFactoryType  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFactoryType $request)
    {
        $request->validate([
            'name' => 'required|string|unique:factory_type'
        ]);

        $translation = $this->factoryTypeRepository->create($request->all());
        $className = $this->resourceItem();

        return new $className($translation);

        /*\DB::beginTransaction();
        try {
            $translation = $this->factoryTypeRepository->create($request->all());

            if ($translation) {
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
     * @param  \App\Http\Requests\BackOffice\FactoryType\UpdateFactoryType  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFactoryType $request, $id)
    {
        //$model = FactoryType::find($id);
        $translation = $this->factoryTypeRepository->update($request->all(), $id);
        $className = $this->resourceItem();

        return new $className($translation);

        /*if ($model) {
            \DB::beginTransaction();
            try {
                $translation = $this->factoryTypeRepository->update($request->all(), $id);

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
        $factoryType = $this->factoryTypeRepository->delete($id);

        return $factoryType;
    }

    /**
     * This method will return the list of queried translations
     * This method will also apply search and pagination to the request
     *
     * @param $request <Illuminate\Http\Request>
     *
     * @return <array>
     */
    public function getFactoryTypes(Request $request)
    {
        $searchString = $request->input('searchString');
        $status = $request->input('is_active');

        $factoryTypes = FactoryType::select();

        if ($searchString) {
            $factoryTypes->where(function ($q) use ($searchString) {
                $q->where('name', 'like', "%$searchString%");
                $q->orWhere('description', 'like', "%$searchString%");
            });
        }

        $factoryTypes = $factoryTypes->with(['translations']);
        $factoryTypes = $factoryTypes->orderBy('id', 'DESC')->paginate($request->input('size'));

        return $factoryTypes;
    }

    public function getFactoryTypesForAddress()
    {
        $factoryTypes = FactoryType::get();

        return response()->json([
            'factory_types' => $factoryTypes
        ], 200);
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\Sns\SnsListResource::class;
    }
}
