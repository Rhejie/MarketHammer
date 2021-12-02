<?php

namespace App\Http\Controllers\BackOffice\Business;

use App\Http\Controllers\Controller;
use App\Model\Business\BusinessProcesses;
use App\Model\Processes;
use App\Repositories\Business\BusinessProcessesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusinessProcessesController extends Controller
{
    //
    private $businessProcessesRepository;
    public function __construct(BusinessProcessesRepository $businessProcessesRepository)
    {
        $this->businessProcessesRepository = $businessProcessesRepository;
    }

    public function store(Request $request)
    {
        $request->validate([
            'business_id' => 'required',
        ]);

        $businessProcesses = $this->businessProcessesRepository->createProcesses(json_decode(json_encode($request->all())));

        return response()->json($businessProcesses, 200);
    }

    public function showBusinessProcesses($id)
    {
        $businessProcesses = $this->businessProcessesRepository->showProcesses($id);

        return response()->json($businessProcesses, 200);
    }
    public function getProcessesData(Request $request)
    {
        $search = $request->input('query');
        $business_id = $request->input('business_id');

        $processes = Processes::with('processType')->whereDoesntHave('businessProcesses', function ($query) use ($business_id) {
            $query->where('business_id', $business_id);
        });
        // $processes = DB::table('processes')->with('processType');

        if ($search) {

            $processes->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
            });
        }

        $data = $processes->get();

        return response()->json($data, 200);
    }

    public function deleteProcesses($id)
    {
        $processes = BusinessProcesses::find($id);
        $processes->delete();

        return response()->json([
            'message' => 'successfully deleted'
        ], 200);
    }

    public function deleteProcessesByName(Request $request) {
        if(is_string($request->name)) {
            $p = Processes::where('name', $request->name)->first();
            if(!empty($p)) {
                $bp = BusinessProcesses::where('business_id', $request->business_id)->where('processes_id', $p->id)->first();
                if(!empty($bp)) {
                    $bp->delete();
                    return response()->json(['Successfully deleted'], 200);
                }
                return response()->json(['No data to be deleted'], 200);
            }
        }
        else {
            $bp = BusinessProcesses::where('business_id', $request->business_id)->where('processes_id', $request->name)->first();
            if(!empty($bp)) {
                $bp->delete();
                return response()->json(['Successfully deleted'], 200);
            }
            else {
                return response()->json(['No data to be deleted'], 200);
            }
        }

        return response()->json(['No data to be deleted'], 200);
    }
}
