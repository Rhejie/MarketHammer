<?php

namespace App\Http\Controllers\BackOffice\Setting;

use App\Http\Controllers\Controller;
use App\Repositories\Certification\{CertificationHolderRepository, CertificationTypeRepository};
use Illuminate\Http\Request;

class SettingController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificationTypes = $this->certificationTypeRepository->getCertificationTypes();
        $certificationHolders = (new CertificationHolderRepository(new \App\Model\CertificationHolder))->getAll();

        return view('backoffice/setting/setting-index', [
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
