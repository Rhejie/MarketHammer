<?php

namespace App\Http\Controllers\BackOffice\Setting;

use App\Http\Controllers\Controller;
use App\Model\MachineProcessType;
use App\Model\Processes;
use App\Repositories\Processes\ProcessesRepository;
use Illuminate\Http\Request;

class ProcessessController extends Controller
{
    private $processRepository;

    public function __construct(ProcessesRepository $processesRepository)
    {
        $this->processRepository = $processesRepository;
    }

    public function index(Request $request)
    {
        $page = $request->page ? $request->page : 1;
        $count = $request->count ? $request->count : 10;
        $search = $request->search && $request->search != '' && $request->search !== 'null' ? $request->search : null;

        $params = [
            'page' => $page,
            'count' => $count,
            'search' => $search
        ];

        $processes = $this->processRepository->getProcessesList(json_decode(json_encode($params)));

        return response()->json($processes, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'process_type_id' => 'required|integer',
            'name' => 'required|string',
        ]);

        $process =  $this->processRepository->store(json_decode(json_encode($request->all())));

        return response()->json($process, 200);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $process = $this->processRepository->update($id, json_decode(json_encode($request->all())));

        return response()->json($process, 200);
    }

    public function destroy($id)
    {
        $process = Processes::find($id);
        $process->delete();

        return response()->json([
            'message' => 'Successfully Deleted'
        ], 200);
    }

    public function processType()
    {
        $type = MachineProcessType::get();

        return response()->json($type, 200);
    }
}
