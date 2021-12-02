<?php

namespace App\Http\Controllers\BackOffice\Setting;

use Illuminate\Http\Request;
use App\Model\Setting\AddressType;
use App\Http\Controllers\Controller;
use App\Repositories\AddressType\AddressTypeRepository;
use App\Http\Requests\BackOffice\AddressType\{StoreAddressType, UpdateAddressType};

class AddressTypeController extends Controller
{
    /**
     * The abstraction layer for the translation module
     *
     * @var BusinessCertificationRepository
     */
    private $addressTypeRepository;

    public function __construct(AddressTypeRepository $addressTypeRepository)
    {
        $this->addressTypeRepository = $addressTypeRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BackOffice\AddressType\StoreAddressType  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddressType $request)
    {
        $translation = $this->addressTypeRepository->create($request->all());
        $className = $this->resourceItem();
        return new $className($translation);

        /*\DB::beginTransaction();
        try {
            $translation = $this->addressTypeRepository->create($request->all());

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
     * @param  \App\Http\Requests\BackOffice\AddressType\UpdateAddressType  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAddressType $request, $id)
    {
        //$model = AddressType::find($id);

        $translation = $this->addressTypeRepository->update($request->all(), $id);
        $className = $this->resourceItem();

        return new $className($translation);

        /*if ($model) {
            \DB::beginTransaction();
            try {
                $translation = $this->addressTypeRepository->update($request->all(), $id);

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
        $addressType = $this->addressTypeRepository->delete($id);

        return $addressType;
    }

    /**
     * This method will return the list of queried translations
     * This method will also apply search and pagination to the request
     *
     * @param $request <Illuminate\Http\Request>
     *
     * @return <array>
     */
    public function getAddressTypes(Request $request)
    {
        $searchString = $request->input('searchString');

        $addressType = AddressType::orderBy('id', 'DESC')->select();

        if ($searchString) {
            $addressType->where(function ($q) use ($searchString) {
                $q->where('name', 'like', "%$searchString%");
                $q->orWhere('description', 'like', "%$searchString%");
            })->orderBy('id', 'DESC');
        }

        $addressType = $addressType->with(['translations']);
        $addressType = $addressType->paginate($request->input('size'));

        return $addressType;
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\Sns\SnsListResource::class;
    }
}
