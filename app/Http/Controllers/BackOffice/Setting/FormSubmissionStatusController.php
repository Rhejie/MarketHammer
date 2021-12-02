<?php

namespace App\Http\Controllers\Backoffice\Setting;

use App\Http\Controllers\Controller;
use App\Model\FormSubmissionStatus;
use App\Repositories\FormSubmissionStatus\FormSubmissionStatusRepository;
use Illuminate\Http\Request;

class FormSubmissionStatusController extends Controller
{
    private $formStatusRepository;

    public function __construct(FormSubmissionStatusRepository $formStatusRepository)
    {
        $this->formStatusRepository = $formStatusRepository;
    }

    public function index(Request $request)
    {
        /*$searchString = $request->input('searchString');

        $formStatuses = FormSubmissionStatus::select();

        if ($searchString) {
            $formStatuses->where(function ($q) use ($searchString) {
                $q->where('name', 'like', "%$searchString%");
            });
        }

        $formStatuses = $formStatuses->with('translations')->orderBy('id', 'DESC')->paginate($request->input('size'));

        return response()->json($formStatuses, 200);*/
        $page = $request->page ? $request->page : 1;
        $count = $request->count ? $request->count : 10;
        $search = $request->search && $request->search != '' && $request->search !== 'null' ? $request->search : null;

        $params = [
            'page' => $page,
            'count' => $count,
            'search' => $search
        ];

        $formStatuses = $this->formStatusRepository->get(json_decode(json_encode($params)));

        return response()->json($formStatuses, 200);
    }

    public function store(Request $request)
    {
        $formStatus = $this->formStatusRepository->create(json_decode(json_encode($request->all())));

        return response()->json($formStatus, 200);
    }

    public function update($id, Request $request)
    {
        $formStatus = $this->formStatusRepository->update($id, json_decode(json_encode($request->all())));

        return response()->json($formStatus, 200);
    }

    public function destroy($id)
    {
        $this->formStatusRepository->delete($id);

        return response()->json([
            'message' => 'successfully deleted',
            'status_code' => 200
        ], 200);
    }
}
