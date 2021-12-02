<?php

namespace App\Http\Controllers\BackOffice\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Country;
use App\Repositories\SystemData\StateRepository;

class StateController extends Controller
{
    public function __construct(StateRepository $stateRepository)
    {
        $this->stateRepository = $stateRepository;
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
        $updatedState = $this->stateRepository->updateState($request->all(), $id);
        return response()->json($updatedState, 200);
    }

	/**
	 * Fetch list of countries
	 */
    public function getState(Request $request)
    {
    	$state = $this->stateRepository->getList($request);
        return ['state' => $state];
    }

}
