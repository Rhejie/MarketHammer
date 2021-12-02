<?php

namespace App\Http\Controllers\BackOffice\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Setting\CertificationType;
use App\Repositories\Certification\CertificationTypeRepository;
use App\Http\Requests\BackOffice\CertificationType\{StoreCertificationType, UpdateCertificationType};

class CertificationTypeController extends Controller
{
    /**
     * The abstraction layer for the translation module
     *
     * @var BusinessCertificationRepository
     */
    private $certificationTypeRepository;

    public function __construct(CertificationTypeRepository $certificationTypeRepository)
    {
        $this->certificationTypeRepository = $certificationTypeRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BackOffice\CertificationType\StoreCertificationType  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCertificationType $request)
    {
        $translation = $this->certificationTypeRepository->create($request->all());
        $className = $this->resourceItem();

        return new $className($translation);
        /*\DB::beginTransaction();
        try {
            $translation = $this->certificationTypeRepository->create($request->all());

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
     * @param  \App\Http\Requests\BackOffice\CertificationType\UpdateCertificationType  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCertificationType $request, $id)
    {
        //$model = CertificationType::find($id);
        $updateCertificateType = $this->certificationTypeRepository->update($request->all(), $id);
        $className = $this->resourceItem();

        return response()->json($updateCertificateType, 200);

        // return new $className($translation);
        /*if ($model) {
            \DB::beginTransaction();
            try {
                $translation = $this->certificationTypeRepository->update($request->all(), $id);

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
        $certificationType = $this->certificationTypeRepository->delete($id);

        return $certificationType;
    }

    /**
     * This method will return the list of queried translations
     * This method will also apply search and pagination to the request
     *
     * @param $request <Illuminate\Http\Request>
     *
     * @return <array>
     */
    public function getCertificationTypes(Request $request)
    {
        $searchString = $request->input('searchString');

        $certificationType = CertificationType::select();

        if ($searchString) {
            $certificationType->where(function ($q) use ($searchString) {
                $q->where('name', 'like', "%$searchString%");
                $q->orWhere('description', 'like', "%$searchString%");
            });
        }

        $certificationType = $certificationType->with(['translations']);
        $certificationType = $certificationType->orderBy('id', 'DESC')->paginate($request->input('size'));

        // return $certificationType;
        return response()->json($certificationType, 200);
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\Sns\SnsListResource::class;
    }
}
