<?php
    
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Repositories\User\AuditTrailRepository;
    
class AuditTrailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(AuditTrailRepository $auditTrailRepository)
    {
        $this->auditTrailRepository = $auditTrailRepository;
    }

    public function store(Request $request)
    {
        $material = $this->auditTrailRepository->create($request->all());
        $className = $this->resourceItem();

        return new $className($material);
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\DefaultResource::class;
    }
}