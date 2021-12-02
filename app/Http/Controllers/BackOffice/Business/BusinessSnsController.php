<?php

namespace App\Http\Controllers\BackOffice\Business;

use Illuminate\Http\Request;
use App\Model\Business\BusinessSns;
use App\Http\Controllers\Controller;

class BusinessSnsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes['business_id'] = $request->input('business_id'); 
        $attributes['sns_id'] = $request->input('sns_id'); 
        $attributes['account_info'] = $request->input('account_info'); 

        \DB::beginTransaction();
        try {
            $model = new BusinessSns;
            $model->fill($attributes);
            $model->created_at = __utc_time_now();

            if (!$model->validate()) return ['success' => false, 'errors' => $model->errors];

            $success = $model->save();

            if ($success) {
                \DB::commit();

                $data = BusinessSns::where('id', $model->id)
                ->select()
                ->with(['sns' => function ($q) {
                    $q->select(['id', 'name', 'website', 'color']);
                }])
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = BusinessSns::find($id);

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
    public function getBusinessSnsList(Request $request)
    {
        $businessId = $request->input('business_id');

        $businessAddresses = BusinessSns::select()
        ->where('business_id', $businessId)
        ->with(['sns' => function ($q) {
            $q->select(['id', 'name', 'website', 'color']);
        }]);

        return $businessAddresses->get()->toArray();
    }
}
