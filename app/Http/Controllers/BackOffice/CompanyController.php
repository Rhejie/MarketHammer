<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Events;
use App\Repositories\Company\CompanyRepository;

class CompanyController extends Controller
{

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }


    public function store(Request $request)
    {
        $company = $this->companyRepository->create($request->all());
        $className = $this->resourceItem();

        return new $className($company);
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\DefaultResource::class;
    }
}
