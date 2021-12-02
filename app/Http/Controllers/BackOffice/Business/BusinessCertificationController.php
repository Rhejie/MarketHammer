<?php

namespace App\Http\Controllers\BackOffice\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Business\{BusinessCertification};
use App\Repositories\Business\BusinessCertificationRepository;
use App\Http\Requests\BackOffice\Business\BusinessCertification\{StoreBusinessCertification, UpdateBusinessCertification};

class BusinessCertificationController extends Controller
{
    /**
     * The abstraction layer for the business repository module
     *
     * @var BusinessCertificationRepository
     */
    private $businessCertificationRepository;

    public function __construct(BusinessCertificationRepository $businessCertificationRepository)
    {
        $this->businessCertificationRepository = $businessCertificationRepository; 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBusinessCertification $request)
    {
        $attributes['business_id'] = json_decode($request->input('business_id')); 
        $attributes['certification_id'] = json_decode($request->input('certification_id')); 
        $attributes['certification_no'] = $request->input('certification_no'); 
        $attributes['name'] = strtolower($request->input('name'));
        $attributes['description'] = in_array($request->input('description'), ['null', 'undefined']) 
            ? json_decode($request->input('description')) : $request->input('description'); 
        $attributes['is_verified'] = json_decode($request->input('is_verified')); 
        $attributes['issued_date'] = $request->input('issued_date'); 
        $attributes['expiry_date'] = $request->input('expiry_date');

        \DB::beginTransaction();
        try {
            $certification = $this->businessCertificationRepository->create($attributes);

            if ($certification) {
                if ($request->hasFile('fileList')) {
                    $medias = $this->businessCertificationRepository->saveNewCertificationMedias($request->file('fileList'), $certification->id);
                }

                \DB::commit();

                $certification = $certification->loadMissing('medias');

                $className = $this->resourceItem();

                return new $className($certification);
            }
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
    public function update(UpdateBusinessCertification $request, $id)
    {
        $attributes['business_id'] = json_decode($request->input('business_id')); 
        $attributes['certification_id'] = json_decode($request->input('certification_id')); 
        $attributes['certification_no'] = $request->input('certification_no'); 
        $attributes['name'] = strtolower($request->input('name')); 
        $attributes['description'] = in_array($request->input('description'), ['null', 'undefined']) 
            ? json_decode($request->input('description')) : $request->input('description'); 
        $attributes['is_verified'] = json_decode($request->input('is_verified')); 
        $attributes['issued_date'] = $request->input('issued_date'); 
        $attributes['expiry_date'] = $request->input('expiry_date');

        $savedFiles = $request->input('savedFiles');
        $toDeleteFiles = [];

        if ($savedFiles) {
            $savedFiles = array_map(function ($q) {
                return json_decode($q, true);
            }, $savedFiles);

            $toDeleteFiles = array_column(array_filter($savedFiles, function ($q) {
                return $q['is_deleted'];
            }), 'id');
        }

        $model = BusinessCertification::find($id);

        if ($model) {
            \DB::beginTransaction();
            try {
                $certification = $this->businessCertificationRepository->update($attributes, $id);

                if ($certification) {
                    // delete files from storage
                    if ($toDeleteFiles) {
                        $this->businessCertificationRepository->deleteCertificationMedias($toDeleteFiles);
                    }

                    if ($request->hasFile('fileList')) {
                        $medias = $this->businessCertificationRepository->saveNewCertificationMedias($request->file('fileList'), $certification->id);
                    }

                    \DB::commit();

                    $certification = $certification->loadMissing('medias');

                    $className = $this->resourceItem();

                    return new $className($certification);
                }
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $certification = $this->businessCertificationRepository->delete($id);

        return $certification;
    }

    /**
     * Download the import template for Orders
     */
    public function exportCertifications(Request $request)
    {
        $collections = new \App\Exports\BusinessCertificationExport($request->all());

        return \Excel::download($collections, 'Business Certification.xlsx');
    }

    /**
     * Retrieve list of business addresses
     *
     * @param $request <Request>
     *
     * @return <array>
     */
    public function getCertifications(Request $request)
    {
        $businessId = $request->input('business_id');

        $certifications = BusinessCertification::select()
        ->with(['medias'])
        ->where('business_id', $businessId);

        return $certifications->get()->toArray();
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\Business\BusinessContactResource::class;
    }

    protected function resourceCollection(): string
    {
        return \App\Http\Resources\Business\ProductCollection::class;
    }
}
