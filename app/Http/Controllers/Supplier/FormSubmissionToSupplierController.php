<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Rfq\FormSubmissionToSupplierRepository;

class FormSubmissionToSupplierController extends Controller
{
	public function __construct(FormSubmissionToSupplierRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $answer = $this->repository->create($request->all());
        $className = $this->resourceItem();

        return new $className($answer);
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
        $answer = $this->repository->update($request->all(), $id);
        $className = $this->resourceItem();

        return new $className($answer);
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
