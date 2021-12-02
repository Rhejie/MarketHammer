<?php

namespace App\Http\Controllers\BackOffice\Business;

use Illuminate\Http\Request;
use App\Model\BusinessAddress;
use App\Model\Setting\AddressType;
use App\Http\Controllers\Controller;
use App\Model\Country;

class BusinessAddressController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country_name = Country::find($request->input('country_id'));

        $attributes['address_type_id'] = $request->input('address_type_id');
        $attributes['factory_type_id'] = $request->input('factory_type_id');
        $attributes['usage_area_id'] = $request->input('usage_area_id');
        $attributes['lot_area_size'] = $request->input('lot_area_size');
        $attributes['manufacturer_area_size'] = $request->input('manufacturer_area_size');
        $attributes['incidental_area_size'] = $request->input('incidental_area_size');
        $attributes['building_area_size'] = $request->input('building_area_size');
        $attributes['address_line_1'] = $request->input('address_line_1');
        $attributes['address_line_2'] = $request->input('address_line_2');
        $attributes['street'] = strtolower($request->input('street'));
        $attributes['phone'] = $request->input('phone');
        $attributes['postal'] = $request->input('postal');
        $attributes['country_id'] = $request->input('country_id');
        $attributes['state_id'] = $request->input('state_id');
        $attributes['city'] = $request->input('city');
        $attributes['business_id'] = $request->input('business_id');
        $attributes['address'] = $request->input('address_line_1').', '.$request->input('city').', '.$country_name->name;
        $attributes['complex_location_id'] = $request->input('complex_location_id');
        $attributes['complex_type_id'] = $request->input('complex_type_id');

        \DB::beginTransaction();
        try {
            $model = new BusinessAddress;
            $model->fill($attributes);
            $model->created_at = __utc_time_now();

            if (!$model->validate()) return ['success' => false, 'errors' => $model->errors];

            $success = $model->save();

            if ($success) {
                \DB::commit();

                $data = BusinessAddress::where('id', $model->id)
                    ->select()
                    ->with(['addressType' => function ($q) {
                        $q->select(['id', 'name']);
                    }, 'country'])
                    ->first()->toArray();



                return ['success' => true, 'data' => $data];
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
        $country_name = Country::find($request->input('country_id'));

        $attributes['address_type_id'] = $request->input('address_type_id');
        $attributes['factory_type_id'] = $request->input('factory_type_id');
        $attributes['usage_area_id'] = $request->input('usage_area_id');
        $attributes['lot_area_size'] = $request->input('lot_area_size');
        $attributes['manufacturer_area_size'] = $request->input('manufacturer_area_size');
        $attributes['incidental_area_size'] = $request->input('incidental_area_size');
        $attributes['building_area_size'] = $request->input('building_area_size');
        $attributes['address_line_1'] = $request->input('address_line_1');
        $attributes['address_line_2'] = $request->input('address_line_2');
        $attributes['street'] = strtolower($request->input('street'));
        $attributes['phone'] = $request->input('phone');
        $attributes['postal'] = $request->input('postal');
        $attributes['country_id'] = $request->input('country_id');
        $attributes['state_id'] = $request->input('state_id');
        $attributes['city'] = $request->input('city');
        $attributes['business_id'] = $request->input('business_id');
         $attributes['address'] = $request->input('address_line_1').', '.$request->input('city').', '.$country_name->name;
        $attributes['complex_location_id'] = $request->input('complex_location_id');
        $attributes['complex_type_id'] = $request->input('complex_type_id');

        $model = BusinessAddress::find($id);

        if ($model) {
            \DB::beginTransaction();
            try {
                $model->fill($attributes);
                $model->updated_at = __utc_time_now();

                if (!$model->validate()) return ['success' => false, 'errors' => $model->errors];

                $success = $model->save();

                if ($success) {
                    \DB::commit();

                    $model = BusinessAddress::where('id', $model->id)
                        ->select()
                        ->with(['addressType' => function ($q) {
                            $q->select(['id', 'name']);
                        }, 'country'])
                        ->first()->toArray();

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
        $model = BusinessAddress::find($id);

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

    /**
     * Retrieve list of business addresses
     *
     * @param $request <Request>
     *
     * @return <array>
     */
    public function getBusinessAddresses(Request $request)
    {
        $businessId = $request->input('business_id');

        $businessAddresses = BusinessAddress::select()
            ->where('business_id', $businessId)
            ->with(['addressType' => function ($q) {
                $q->select(['id', 'name']);
            }, 'country']);

        return $businessAddresses->get()->toArray();
    }
}
