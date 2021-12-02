<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\BusinessList\BusinessListRepository;
use App\Repositories\Permission\BusinessUserTypePermissionRepository;
use App\Repositories\Permission\UserTypePermissionRepository;
use App\Repositories\Rfq\FormSubmissionToSupplierRepository;
use App\Helpers\ChatHelper;
use App\Model\User;

class SupplierController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BusinessListRepository $businessRepository, UserTypePermissionRepository $userTypePermissionRepository, BusinessUserTypePermissionRepository $businessUserTypePermissionRepository, FormSubmissionToSupplierRepository $formSubmissionToSupplierRepository)
    {
        $this->businessRepository = $businessRepository;
        $this->userTypePermissionRepository = $userTypePermissionRepository;
        $this->businessUserTypePermissionRepository = $businessUserTypePermissionRepository;
        $this->formSubmissionToSupplierRepository = $formSubmissionToSupplierRepository;
    }

    /**
     * My Company.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) // previously fetch
    {
        $userId = $request->user_id ? $request->user_id : Auth::user()->id;

        $params = [
            'user_id' => $userId
        ];
        $business = $this->businessRepository->getBusinessData($params);


        if ($request->ajax()) {
            return response()->json(['business' => $business]);
        }

        $pageData = [
            'userId' => $userId,
            'industryTypes' => __get_industry_types(),
            'businessCategories' => __get_business_categories(['id', 'name', 'description', 'industry_type_id', 'ko_stat_code']),
            'snsList' => __get_sns_list(),
            'employeeCounts' => __get_employee_counts(),
        ];

        // return blade
        return view('supplier/index', [
            'business' => $business,
            'pageData' => $pageData
        ]);
    }

    /**
     * Certification Management.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function certification() // previously fetch
    {
        $userId = Auth::user()->id;

        $params = [
            'user_id' => $userId
        ];
        $business = $this->businessRepository->getBusinessData($params);
        $pageData = [
            'userId' => $userId,
        ];

        // return blade
        return view('supplier/certification', [
            'business' => $business,
            'pageData' => $pageData
        ]);
    }

    /**
     * Contact Page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact() // previously fetch
    {
        $userId = Auth::user()->id;

        $params = [
            'user_id' => $userId
        ];
        $business = $this->businessRepository->getBusinessData($params);
        $pageData = [
            'businessList' => [$business],
            'data' => [],
            'isSupplierView' => true,
            'user_id' => $userId,
            'business' => $business
        ];

        // return blade
        return view('supplier/contacts', [
            'pageData' => $pageData
        ]);
    }

    /**
     * Machine
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function machine() // previously fetch
    {
        $userId = Auth::user()->id;

        $params = [
            'user_id' => $userId
        ];
        $business = $this->businessRepository->getBusinessData($params);
        $pageData = [
            'userId' => $userId,
        ];

        // return blade
        return view('supplier/machine', [
            'business' => $business,
            'pageData' => $pageData
        ]);
    }

    /**
     * Machine
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function product() // previously fetch
    {
        $userId = Auth::user()->id;

        $params = [
            'user_id' => $userId
        ];
        $business = $this->businessRepository->getBusinessData($params);
        $pageData = [
            'userId' => $userId,
            'loadMetData' => true,
            'loadCreateForm' => true
        ];

        // return blade
        return view('supplier/product', [
            'business' => $business,
            'pageData' => $pageData
        ]);
    }

    /**
     * Machine
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function permission() // previously fetch
    {
        $userId = Auth::user()->id;

        $params = [
            'user_id' => $userId
        ];
        $business = $this->businessRepository->getBusinessData($params);
        $permissionList = $this->userTypePermissionRepository->all();

        $pageData = [
            'business' => $business,
            'permissions' => $permissionList
        ];

        // return blade
        return view('supplier/permission', [
            'pageData' => $pageData
        ]);
    }

    public function message()
    {
        $chatHelper = new ChatHelper;
        $getToken = $chatHelper->getToken();
        $token = $getToken['token'] ?? null;

        $users = User::with(['usertype'])->get();

        /* return response()->json(['users' => $users, 'activeUser' => Auth::user()]); */

        $pageData = [
            'token' => $token,
            'users' => $users,
            'activeUser' => Auth::user()
        ];

        return view('buyer/message', [
            'pageData' => $pageData,
            'page' => 'supplier'
        ]);
    }

    public function rfq()
    {
        $userId = Auth::user()->id;
        $params = [
            'user_id' => $userId
        ];
        $business = $this->businessRepository->getBusinessData($params);
        $pageData = [
            'business' => $business,
            'activeUser' => Auth::user()
        ];
        return view('supplier/forms', [
            'pageData' => $pageData,
            'page' => 'supplier'
        ]);
    }
}
