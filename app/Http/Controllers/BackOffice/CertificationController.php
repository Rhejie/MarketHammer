<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\Certification\CertificationRepository;
use App\Repositories\Certification\CertificationTypeRepository;
use App\Repositories\Certification\CertificationHolderRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    public function __construct(CertificationRepository $repository, CertificationHolderRepository $certificationHolderRepository)
    {
        $this->repository = $repository;
        $this->certificationHolderRepository = $certificationHolderRepository;
    }

    public function index(Request $request)
    {
        $count = $request->count ? $request->count : 10;
        $search = $request->search && $request->search != '' ? $request->search : null;
        $filter = $request->filter && $request->filter != '' ? $request->filter : null;

        $params = [
            'count' => $count,
            'search' => $search,
            'filter' => json_decode($filter)
        ];

        $certifications = (new CertificationRepository(new \App\Model\Certification))->getCertifications(json_decode(json_encode($params)));

        //var_dump($certifications);die;
        $certificationTypes = (new CertificationTypeRepository(new \App\Model\Setting\CertificationType))->getCertificationTypes();
        $certificationHolders = $this->certificationHolderRepository->getAll();

        if ($request->ajax()) {
            return response()->json(['certifications' => $certifications]);
        }

        return view('backoffice.certification.index', [
            'certifications' => $certifications,
            'certificationTypes' => $certificationTypes,
            'certificationHolders' => $certificationHolders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newCertification = $this->repository->create($request->all());

        // return response()->json($newCertification, 200);
        return response()->json($newCertification, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $certification = $this->repository->get($id)->loadMissing(['translations']);

        return response()->json(['certification' => $certification]);
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
        $updatedCertification = $this->repository->update($request->all(), $id);

        // return response(null, 204);
        return response()->json($updatedCertification, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::beginTransaction();

        try {
            $deleteIndustryType = $this->repository->delete($id);

            \DB::commit();
        } catch (\Exception $th) {
            throw $th;
        }

        return response(null, 204);
    }
}
