<?php

namespace App\Http\Controllers\BackOffice\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Country;
use App\Repositories\SystemData\CountryRepository;

class CountryController extends Controller
{
    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
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
        $updateCountry = $this->countryRepository->updateCountry($request->all(), $id);
        return response()->json($updateCountry, 200);
    }

	/**
	 * Fetch list of countries
	 */
    public function getCountries(Request $request)
    {
    	$size = $request->input('size');
    	$searchString = $request->input('searchString');

    	$countries = Country::select()->with(['translations', 
            'states' => function($q){
                $q->with(['translations']);
        }]);

    	if ($searchString) {
            $countries->where(function($q) use ($searchString) {
                $q->where('country_code', 'like', "%$searchString%");
                $q->orWhere('name', 'like', "%$searchString%");
                $q->orWhere('currency', 'like', "%$searchString%");
            });
        }

		$countries = $countries->paginate($request->input('size'));

    	return $countries;
    }

    /**
     * Retrieve all countries 
     */
    public function getAllCountries(Request $request)
    {
        return $countries = Country::select(['id', 'country_code', 'name', 'currency'])->get()->toArray();
    }
}
