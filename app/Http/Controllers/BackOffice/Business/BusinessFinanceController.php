<?php

namespace App\Http\Controllers\BackOffice\Business;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Business\BusinessFinance;
use App\Repositories\Business\BusinessFinanceRepository;
use App\Http\Requests\BackOffice\Business\BusinessFinance\{StoreBusinessFinance, UpdateBusinessFinance};

class BusinessFinanceController extends Controller
{
    /**
     * The abstraction layer for the business repository module
     *
     * @var BusinessFinanceRepository
     */
    private $busiessFinanceRepository;

    public function __construct(BusinessFinanceRepository $busiessFinanceRepository)
    {
        $this->busiessFinanceRepository = $busiessFinanceRepository; 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBusinessFinance $request)
    {
        \DB::beginTransaction();
        try {
            $finance = $this->busiessFinanceRepository->create($request->all());

            if ($finance) {
                \DB::commit();

                $className = $this->resourceItem();

                return new $className($finance);
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
    public function update(UpdateBusinessFinance $request, $id)
    {
        $model = BusinessFinance::find($id);

        if ($model) {
            \DB::beginTransaction();
            try {
                $finance = $this->busiessFinanceRepository->update($request->all(), $id);

                if ($finance) {
                    \DB::commit();

                    $className = $this->resourceItem();

                    return new $className($finance);
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
        $finance = $this->busiessFinanceRepository->delete($id);

        return $finance;
    }

    /**
     * This method will return the list of queried business finances
     * This method will also apply search and pagination to the request
     *
     * @param $request <Illuminate\Http\Request>
     *
     * @return <array>
     */
    public function getBusinessFinances(Request $request)
    {
        $searchString = $request->input('searchString');

        $businessFinances = BusinessFinance::where('business_id', $request->input('business_id'))
        ->select();

        if ($searchString) {
            $businessFinances->where(function($q) use ($searchString) {
                $q->where('year', 'like', "%$searchString%");
                $q->orWhere('revenue', 'like', "%$searchString%");
                $q->orWhere('ebit', 'like', "%$searchString%");
            });
        }

        $businessFinances = $businessFinances->paginate($request->input('size'));

        return $businessFinances;
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\Translation\TranslationResource::class;
    }
}
