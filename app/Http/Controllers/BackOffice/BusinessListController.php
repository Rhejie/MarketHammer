<?php

namespace App\Http\Controllers\BackOffice;

use App\Exports\BusinessKeywordExport;
use App\Exports\BusinessListExportExcel;
use Illuminate\Http\Request;
use App\Repositories\BusinessList\BusinessListRepository;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\Controller;
use App\Model\Plans;
use App\Model\{Bookmarks, Business, BusinessCategory, FieldValueTranslator, IndustryType};
use App\Model\ComplexLocation;
use App\Model\ComplexType;
use App\Model\Country;
use App\Model\EmployeeCount;
use App\Model\BusinessType;
use App\Model\UserSearchHistories;
use App\Model\BusinessClaims;
use App\Model\BusinessClaimFiles;
use App\Model\Business\BusinessMedia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use \App\Service\Business\BusinessListService;
use Maatwebsite\Excel\Facades\Excel;
// use Excel;

use App\Imports\PreviewImport;
use App\Imports\BusinessImportFromExcel;
use App\Imports\BusinessKeywords;
use App\Imports\PreviewBusinessKeywords;
use App\Model\Business\BusinessNda;

class BusinessListController extends Controller
{
    private $service;

    /**
     * The abstraction layer for the business repository module
     *
     * @var BusinessCertificationRepository
     */
    private $businessRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BusinessListRepository $businessRepository, BusinessListService $service)
    {
        // $this->middleware('auth'); // moved middleware to routes to fix errors for guest users (featured & nearest stores)
        $this->service = $service;

        $this->businessRepository = $businessRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) // previously fetch
    {
        $userId = $request->user_id ? $request->user_id : Auth::user()->id;

        if ($request->ajax()) {
            $businessList = $this->businessRepository->getBusinessList($userId, $request);
            return response()->json(['businessList' => $businessList]);
        }

        // return blade

        return view('backoffice/business-list', [
            'countries' => __get_country_list(),
            'addressTypes'  => __get_address_types(),
            'factoryTypes' => __get_factory_types(),
            'industryTypes' => __get_industry_types(),
            'businessCategories' => __get_business_categories(['id', 'name', 'description', 'industry_type_id', 'ko_stat_code']),
            'employeeCounts' => __get_employee_counts(),
            'snsList' => __get_sns_list(),
            'certifications' => \App\Repositories\Business\BusinessCertificationRepository::getCertifications(),
            'complexType' => __get_complex_types(),
            'complexLocation' => __get_complex_locations(),
            'usage_area' => __get_usage_area()
        ]);
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
        $attributes['industry_type_id'] = json_decode($request->input('industry_type_id'));
        $attributes['business_category_id'] = json_decode($request->input('business_category_id'));
        $attributes['legal_name'] = $request->input('legal_name');
        $attributes['english_name'] = $request->input('english_name');
        $attributes['date_established'] = $request->input('date_established');
        $attributes['status'] = $request->input('status');
        $attributes['website'] = $request->input('website');
        $attributes['email'] = $request->input('email');
        $attributes['employee_count_id'] = json_decode($request->input('employee_count_id'));
        $attributes['rnd_staff_count_id'] = json_decode($request->input('rnd_staff_count_id'));
        $attributes['eid'] = strtolower($request->input('eid'));
        $attributes['phone'] = strtolower($request->input('phone'));
        $attributes['fax'] = $request->input('fax');
        $attributes['complex_type_id'] = json_decode($request->input('complex_type_id'));
        $attributes['complex_location_id'] = json_decode($request->input('complex_location_id'));
        // $attributes['corp_ssn'] = json_decode($request->input('corp_ssn'));
        // $attributes['about_us'] = json_decode($request->input('about_us'));

        $savedFiles = $request->input('savedFiles');
        $toDeleteFiles = [];
        if ($savedFiles) {
            $savedFiles = array_map(function ($q) {
                return json_decode($q, true);
            }, $savedFiles);

            $toDeleteFiles = array_column(array_filter($savedFiles, function ($q) {
                return $q['is_deleted'];
            }), 'id');
        }

        $model = Business::find($id);
        if ($model) {
            \DB::beginTransaction();
            try {
                $model->fill($attributes);
                $model->corp_ssn = $request->input('corp_ssn');
                $model->about_us = $request->input('about_us');

                if ($request->hasFile('imageFile')) {
                    $folder = "/uploads/images/businesses";
                    $media = $request->file('imageFile');
                    $name = $model->id . '_' . sha1(time()) . '.' . $media->extension();
                    $link = $media->storeAs($folder, $name, 'public');

                    // delete old profile
                    \Storage::disk('public')->delete($model->image_url);

                    $model->image_url = $link;
                } else {
                    if (json_decode($request->input('with_image'))) {
                        \Storage::disk('public')->delete($model->image_url);
                        $model->image_url = null;
                    }
                }

                if ($request->hasFile('eid_certificate')) {
                    $folder = "/uploads/eid_attachment";
                    $media = $request->file('eid_certificate');
                    $name = $model->id . '_' . sha1(time()) . '.' . $media->extension();
                    $link = $media->storeAs($folder, $name, 'public');

                    \Storage::disk('public')->delete($model->eid_certificate);

                    $model->eid_file_name_attachment = $request->input('eid_file_name_attachment');

                    $model->eid_certificate = $link;
                } else {
                    if ($request->input('eid_delete')) {
                        \Storage::disk('public')->delete($model->eid_certificate);
                        $model->eid_file_name_attachment = null;
                        $model->eid_certificate = null;
                    } else if (empty($model->eid_file_name_attachment)) {
                        \Storage::disk('public')->delete($model->eid_certificate);
                        $model->eid_file_name_attachment = null;
                        $model->eid_certificate = null;
                    }
                }

                $model->updated_at = __utc_time_now()->format('Y-m-d H:i:d');

                if (!$model->validate()) return ['success' => false, 'errors' => $model->errors];

                $success = $model->save();

                if ($success) {
                    // delete files from storage
                    if ($toDeleteFiles) {
                        $this->businessRepository->deleteBusinessMedias($toDeleteFiles);
                    }

                    if ($request->hasFile('fileList')) {
                        $medias = $this->businessRepository->saveBusinessMedia($request->file('fileList'), $model->id);
                    }

                    if ($request->has('snsList')) {

                        $this->service->updateSnsList(json_decode($request->get('snsList'), true));
                    }

                    \DB::commit();

                    $model = Business::where('id', $model->id)
                        ->with('businessMedias')
                        ->first()->toArray();

                    return ['success' => true, 'data' => $model, 'is_updated' => true];
                }

                return ['success' => false];
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return ['success' => false, 'code' => 'no_model_found'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Business::find($id);

        if ($model) {
            \DB::beginTransaction();
            try {

                \Storage::disk('public')->delete($model->eid_certificate);
                $success = $model->delete();

                if ($success) {
                    \DB::commit();
                    return ['success' => true, 'data' => $id];
                }

                return ['success' => false];
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return ['success' => false, 'code' => 'no_model_found'];
    }

    /* public function deleteBusinessBanner(Request $request)
    {
        // dd($request->id);
        if (isset($request->id) && $request->id > 0) {
            $business = BusinessBanners::find($request->id);
            $delete = $business->delete();

            $success = $delete ? true: false;

            return response()->json(['success' => $success]);
        } else {
            return response()->json(['success' => false]);
        }
    } */

    /**
     * Reciever for creating new business data.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $currentUsee = auth()->user()->id;

        $attributes = $request->all();
        $business = $this->service->saveBusiness($attributes);

        $data = $business['success'] ? $business['model'] : $business['errors'];

        return response([
            'success' => $business['success'],
            'data' => $data,
            'is_updated' => $business['is_updated']
        ]);
    }

    public function saveFromStoreDetails(Request $request)
    {
        // dd($request->all());
        $currentUset = auth()->user()->id;

        $attributes = $request->all();
        $business = $this->service->saveBusinessFromStoreDetails($attributes);

        $data = $business['success'] ? $business['model'] : $business['errors'];

        return response([
            'success' => $business['success'],
            'data' => $data,
        ]);
    }

    public function importBusinessList(Request $request)
    {
        // dd($request->all());
        $currentUset = auth()->user()->id;

        $attributes = $request->all();
        // dd($attributes);
        $business = $this->service->importBusiness($attributes);

        $data = $business['success'] ? $business['model'] : $business['errors'];

        return response([
            'success' => $business['success'],
            'data' => $data,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $businessData = $this->businessRepository->getBusiness($id);
        $businessImage = $this->businessRepository->getBusinessImages($id);


        $data = [
            'businessData' => $businessData,
            'pageData' => [
                'businessImage' => $businessImage,
                'uploadImageRoute' => route('business-list.upload-banners'),
                'uploadVideoRoute' => route('business-list.upload-videos'),
                'storageRoute' => asset('/'),
            ]
        ];

        return view('backoffice/business-view', $data);
    }

    public function getBusiness(Request $request)
    {

        $businessData = $this->businessRepository->getBusinessData($request);
        $data = [
            'businessData' => $businessData
        ];

        return response()->json($data);
    }

    public function searchFilterData(Request $request)
    {
        $filterType = $request->filterType;
        $searchQuery = $request->searchQuery;
        $filterData = null;

        if ($filterType == 'cluster') {
            $filterData = $this->businessRepository->searchCluster($searchQuery);
        }

        if ($filterType == 'category') {
            // Category
            $filterData = $this->businessRepository->searchCategory($searchQuery);
        }

        if ($filterType == 'industryType') {
            $filterData = $this->businessRepository->searchIndustryType($searchQuery);
        }

        return response()->json(['filterData' => $filterData]);
    }

    public function getFormInitialData(Request $request)
    {
        $type = $request->type;

        $industryList = [];
        $countries = [];
        $employeeCountList = [];


        if (in_array('industry', $type)) {
            $industryList = $this->businessRepository->searchIndustryType(null, null, null);
        }

        if (in_array('country', $type)) {
            $countries = Country::get()->toArray();
        }

        if (in_array('employee_count', $type)) {
            $employeeCountList = EmployeeCount::get()->toArray();
            $userCluster = Auth::user()->cluster;
            $data = [
                'industryList' => $industryList,
                'countries' => $countries,
                'employeeCountList' => $employeeCountList
            ];

            return response()->json($data);
        }
    }

    public function getCategories(Request $request)
    {

        $filterData = $request->filterData;
        $filterData = $this->businessRepository->searchCategory(null, $filterData, null);
        return response()->json(['filterData' => $filterData]);
    }

    public function geFeaturedStores(Request $request)
    {
        // dd($request->all());
        $userId = null;


        $search = $request->search && $request->search != '' ? $request->search : null; // search
        $count = $request->count ? $request->count : 10; // pagination
        $category = $request->category && $request->category != 'all' ? $request->category : null; // category
        $radius = isset($request->radius) && $request->radius != '' ? $request->radius : null; // filter - radius

        $coords =  [
            'lat' => $request->user_lat,
            'lng' => $request->user_long
        ];

        $params = [
            'search' => $search,
            'count' => $count,
            // Filters
            'planId' => 2,
            'clusterId' => null,
            'categoryId' => $category,
            'industryTypeId' => null,
            'radius' => $radius,
            'coords' => $coords
        ];

        $businessList = $this->businessRepository->getBusinessList($userId, json_decode(json_encode($params)));

        // dd($businessList);
        return response()->json(['businessList' => $businessList, 'coords' => $coords]);
    }

    public function getUserSearchHistory(Request $request)
    {
        // dd($request->all());
        $userId = $request->userId ? $request->userId : null;

        $businessListIds = $userId != null ? UserSearchHistories::where('userID', $userId)->pluck('businessListID')->toArray() : [];
        // dd($businessListIds);

        $search = $request->search && $request->search != '' ? $request->search : null; // search
        $count = $request->count ? $request->count : 10; // pagination
        $category = $request->category && $request->category != 'all' ? $request->category : null; // category
        $radius = isset($request->radius) && $request->radius != '' ? $request->radius : null; // filter - radius

        $coords =  [
            'lat' => $request->user_lat,
            'lng' => $request->user_long
        ];

        if ($businessListIds != []) {
            $params = [
                'search' => $search,
                'count' => $count,
                // Filters
                'clusterId' => null,
                'categoryId' => $category,
                'industryTypeId' => null,
                'radius' => $radius,
                'coords' => null,
                'businessListIds' => $businessListIds
            ];

            $businessList = $this->businessRepository->getBusinessList($userId, json_decode(json_encode($params)));
        } else {
            $businessList = [];
            $coords = [];
        }


        // dd($businessList);
        return response()->json(['businessList' => $businessList, 'coords' => $coords]);
    }

    public function getBookmarkedStores(Request $request)
    {
        // dd($request->all());
        $userId = $request->userId ? $request->userId : null;

        $businessListIds = Bookmarks::where('userID', $userId)->pluck('businessListID')->toArray();
        // dd($businessListIds);

        $search = $request->search && $request->search != '' ? $request->search : null; // search
        $count = $request->count ? $request->count : 10; // pagination
        $category = $request->category && $request->category != 'all' ? $request->category : null; // category
        $radius = isset($request->radius) && $request->radius != '' ? $request->radius : null; // filter - radius

        $coords =  [
            'lat' => $request->user_lat,
            'lng' => $request->user_long
        ];

        if ($businessListIds != []) {
            $params = [
                'search' => $search,
                'count' => $count,
                // Filters
                'clusterId' => null,
                'categoryId' => $category,
                'industryTypeId' => null,
                'radius' => $radius,
                'coords' => null,
                'businessListIds' => $businessListIds
            ];

            $businessList = $this->businessRepository->getBusinessList($userId, json_decode(json_encode($params)));
        } else {
            $businessList = [];
            $coords = [];
        }


        // dd($businessList);
        return response()->json(['businessList' => $businessList, 'coords' => $coords]);
    }

    public function getNearestStores(Request $request)
    {
        $userId = null;


        $search = $request->search && $request->search != '' ? $request->search : null; // search
        $count = $request->count ? $request->count : 10; // pagination
        $category = $request->category && $request->category != 'all' ? $request->category : null; // category
        $radius = isset($request->radius) && $request->radius != '' ? $request->radius : null; // filter - radius

        $coords =  [
            'lat' => $request->user_lat,
            'lng' => $request->user_long
        ];

        $params = [
            'search' => $search,
            'count' => $count,
            // Filters
            'clusterId' => null,
            'categoryId' => $category,
            'industryTypeId' => null,
            'radius' => $radius,
            'coords' => $coords
        ];

        $businessList = $this->businessRepository->getBusinessList($userId, json_decode(json_encode($params)));


        return response()->json(['businessList' => $businessList, 'coords' => $coords]);
    }

    /* public function importBusinessBanners(Request $request) {
        $businessId = $request->businessID ? $request->businessID : null;
        // dd($request->all());
        // 1. upload image to storage
        $imageFile = (new BusinessListRepository())->importImage($request->file('file'));

        return response()->json(['imageFile' => $imageFile]);
    } */

    public function getBusinessNda($id) {
        $business = BusinessNda::where('business_id', $id)->whereNull('deleted_at')->first();

        if ($business) {
            return response()->json(['success' => true, 'data' => $business]);
        }
        return response()->json(['success' => false]);
    }

    public function importBusinessNda(Request $request) {
        $businessId = $request->id ? $request->id : null;
        $imageFile = $this->businessRepository->importFile($request->file('file'));
        $supplierId = $request->supplier_id ?? null;
        $formSubmissionId = $request->form_submission_id ?? null;
        $business = BusinessNda::where('business_id', $businessId);//->whereNull('deleted_at')->first();

        if($supplierId) {
            $business->where('supplier_id', $supplierId);
        }

        if($formSubmissionId) {
            $business->where('form_submission_id', $formSubmissionId);
        }

        $business->whereNull('deleted_at')->first();

        if (!$business || !isset($business->id)) {
            $nda = new BusinessNda();
            $nda->name = $imageFile['filePath'];
            $nda->file_name = $imageFile['fileName'];
            $nda->business_id = $businessId;
            $nda->supplier_id = $request->supplier_id ?? null;
            $nda->form_submission_id = $request->form_submission_id ?? null;
            $nda->form_submission_to_supplier_id = $request->form_submission_to_supplier_id ?? null;

            if ($nda->save()) {
                return response()->json(['success' => true, 'imageFile' => $imageFile, 'nda' => $nda]);
            }
        }
        return response()->json(['success' => false]);
    }

    public function removeBusinessNda(Request $request) {
        $businessId = $request->id ? $request->id : null;
        $business = BusinessNda::where('business_id', $businessId)->whereNull('deleted_at')->first();

        if ($business) {
            BusinessNda::where('business_id', $businessId)->whereNull('deleted_at')->update(['deleted_at' => now()]);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function importBusinessFiles(Request $request)
    {
        $businessId = $request->businessID ? $request->businessID : null;
        // dd($request->all());
        // 1. upload image to storage
        $file = $this->businessRepository->importFile($request->file('file'));

        return response()->json(['file' => $file]);
    }

    public function importBusinessClaimFiles(Request $request)
    {
        $businessId = $request->businessID ? $request->businessID : null;
        // dd($request->all());
        // 1. upload image to storage
        $file = $this->businessRepository->importClaimFile($request->file('file'));

        return response()->json(['file' => $file]);
    }

    public function importBusinessVideos(Request $request)
    {
        $businessId = $request->businessID ? $request->businessID : null;
        // dd($request->all());
        $videoFile = $this->businessRepository->importImage($request->file('file'));

        return response()->json(['videoFile' => $videoFile]);
    }

    /* public function saveBusinessBanners($id, Request $request) {
        // dd($request->all());
        $businessBanners = (new BusinessListRepository())->saveBusinessBanners($id, $request->all());

        return response(['files' => $businessBanners]);
    } */



    public function saveBusinessClaim(Request $request)
    {
        // dd($request->all());

        $success = false;

        $saveClaim = new BusinessClaims;
        $saveClaim->businessListID = $request->businessListID;
        $saveClaim->name = $request->name;
        $saveClaim->number = $request->number;
        $saveClaim->designation = $request->designation;
        $saveClaim->email = $request->email;
        $saveClaim->save();

        if ($saveClaim) {
            if (count($request->documentFiles) > 0) {
                foreach ($request->documentFiles as $file) {
                    $saveFiles = new BusinessClaimFiles;
                    $saveFiles->businessClaimID = $saveClaim->id;
                    $saveFiles->mediaPath = $file['filePath'];
                    $saveFiles->caption = null;
                    $saveFiles->type = 'file';
                    $saveFiles->save();
                }
            }

            if (count($request->idFiles) > 0) {
                foreach ($request->idFiles as $file) {
                    $saveFiles = new BusinessClaimFiles;
                    $saveFiles->businessClaimID = $saveClaim->id;
                    $saveFiles->mediaPath = $file['filePath'];
                    $saveFiles->caption = null;
                    $saveFiles->type = 'id';
                    $saveFiles->save();
                }
            }

            $success = true;
        }

        return response()->json(['success' => $success]);
    }

    public function markBookmark(Request $request)
    {
        $businessListID = $request->businessListID ? $request->businessListID : null;
        $currentUser = auth()->user()->id;

        $business = $this->service->saveBookmark($currentUser, $businessListID);
        $success = false;
        if ($business) {
            $success = true;
        }

        return response([
            'success' => $success,
            'data' => $business,
        ]);
    }

    /* public function setBannerprimary(Request $request)
    {
        $bannerID = $request->bannerID ? $request->bannerID : null;
        $businessId = $request->businessListID ? $request->businessListID : null;

        $success = false;

        $banners = BusinessBanners::where(['businessListID' => $businessId, 'deleted_at' => null, 'is_primary' => 1])->get();
        foreach ($banners as $ban) {
            $ban->is_primary = 0;
            $ban->save();
        }

        $bannerImg = BusinessBanners::where(['id' => $bannerID])->first();
        if($bannerImg){
            $bannerImg->is_primary = 1;
            if($bannerImg->save()){
                $success = true;
            }
        }

        return response([
            'success' => $success,
            'data' => $bannerImg,
        ]);
    } */

    /* public function removeBanner(Request $request)
    {
        $bannerToremove = $request->bannerIDs ? $request->bannerIDs : null;

        $success = true;
        foreach ($bannerToremove as $ban) {
            $banner = BusinessBanners::where(['id' => $ban])->first();
            if($banner){
                $banner->delete();
            }
        }
        return response([
            'success' => $success,
        ]);
    } */

    public function getPlans(Request $request)
    {
        $plans = Plans::whereNull('deleted_at')->get();
        return response()->json(['plans' => $plans]);
    }

    public function getTypes(Request $request)
    {
        $types = BusinessType::whereNull('deleted_at')->orderBy('name', 'ASC')->orderBy('code', 'ASC')->get();
        return response()->json(['types' => $types]);
    }

    /**
     * Method to fetch list of companies. Depending on the request information
     * this will also paginate the data.
     *
     * @param $request <Request>
     *
     * @return <array>
     */
    public function getBusinessList(Request $request)
    {
        $searchString = $request->input('searchString');
        $size = $request->input('size');

        $businessList = Business::select()
            ->orderBy('business.created_at', 'DESC')
            ->with(['businessMedias']);

        if ($searchString) {
            $businessList->where(function ($query) use ($searchString) {
                $query->orWhere('legal_name', 'LIKE', "%$searchString%");
                $query->orWhere('email', 'LIKE', "%$searchString%");
                $query->orWhere('phone', 'LIKE', "%$searchString%");
                $query->orWhere('created_at', 'LIKE', "%$searchString%");
                $query->orWhere('website', 'LIKE', "%$searchString%");
                $query->orWhere('date_established', 'LIKE', "%$searchString%");
                $query->orWhereHas('category', function ($query2) use ($searchString) {
                    $query2->where(function ($query3) use ($searchString) {
                        $query3->where('name', 'LIKE', "%$searchString%");
                    });
                });
                $query->orWhereHas('businessAddress', function ($query2) use ($searchString) {
                    $query2->where(function ($query3) use ($searchString) {
                        $query3->orWhere('city', 'LIKE', "%$searchString%");
                    });
                });
                $query->orWhereHas('industryType', function ($query2) use ($searchString) {
                    $query2->where(function ($query3) use ($searchString) {
                        $query3->orWhere('name', 'LIKE', "%$searchString%");
                    });
                });
                $query->orWhereHas('businessKeyword', function ($query2) use ($searchString) {
                    $query2->where(function ($query3) use ($searchString) {
                        $query3->orWhere('name', 'LIKE', "%$searchString%");
                    });
                });
                /*$query->orWhere('description', 'LIKE', "%$searchString%");
                $query->orWhere('email', 'LIKE', "%$searchString%");
                $query->orWhere('phone', 'LIKE', "%$searchString%");
                $query->orWhere('webAddress', 'LIKE', "%$searchString%");
                $query->orWhere('businessLicense', 'LIKE', "%$searchString%");
                $query->orWhereHas('businessAddress', function($query2) use ($searchString) {
                    $query2->where(function($query3) use ($searchString) {
                        $query3->orWhere('street', 'LIKE', "%$searchString%");
                        $query3->orWhere('city', 'LIKE', "%$searchString%");
                        $query3->orWhere('state', 'LIKE', "%$searchString%");
                        $query3->orWhere('zip', 'LIKE', "%$searchString%");
                        $query3->orWhereHas('country', function($query4) use ($searchString) {
                            $query4->where('name', 'LIKE', "%$searchString%");
                        });
                    });
                });*/
            });
        }

        if ($size) {
            $businessList = $businessList->paginate($size);

            return ['success' => true, $businessList];
        } else {
            $businessList = $businessList->get()->toArray();
        }

        return ['success' => true, 'data' => $businessList];
    }

    public function downloadImage($id)
    {

        $file = BusinessMedia::find($id);

        // $path = \Storage::disk('public')->path($file->media_url);
        // // return response()->download($content);
        // return \Storage::download($path)->withHeaders([
        //     'Content-type' => mime_content_type($file->media_type)
        // ]);
        // if (Storage::disk('public')->exists($file->media_url)) {
        //     $p = \Storage::disk('public')->path($file->media_url);
        //     // $p = public_path('storage/') . $file->media_url;
        //     // $path = \Storage::copy($p);
        //     $content = file_get_contents(public_path() . $file->media_ur, $file->media_ur, null);

        //     return \Storage::download($content)->withHeaders([
        //         'Content-type' => mime_content_type($file->media_type)
        //     ]);
        // }
    }

    public function importBusinessFromExcel(Request $request)
    {
        ini_set('max_execution_time', 3000);
        ini_set('memory_limit', '3000M');
        $request->validate([
            'import_file' => 'required|file|mimes:xls,xlsx'
        ]);

        $import = new BusinessImportFromExcel;

        $file = $request->file('import_file');
        $import->import($file);

        return response()->json([
            'errors' => $import->getErrorMessage(),
            'totalImported' => $import->getNumberOfImported()
        ], 200);

        // return response()->json([
        //     'errors' => $import->failures()->map(function ($item, $key) {
        //         return [
        //             'row' => $item->row(),
        //             'attribute' => $item->attribute(),
        //             'errors' => $item->errors(),
        //             'values' => $item->values()
        //         ];
        //     }),
        // ], 200);
    }

    public function importBusinessKeywordFromExcel(Request $request)
    {
        ini_set('max_execution_time', 3000);
        ini_set('memory_limit', '3000M');
        $request->validate([
            'import_file' => 'required|file|mimes:xls,xlsx'
        ]);

        $import = new BusinessKeywords;

        $file = $request->file('import_file');
        $import->import($file);
        return response()->json([
            'errors' => $import->getErrorsKeywords(),
            'totalImported' => $import->getNumberOfImported()
        ], 200);
    }
    public function customImportExcel(Request $request)
    {
        $rows = (int) $request->totalRows;
        if($rows > 10) {
            ini_set('max_execution_time', 3000);
            ini_set('memory_limit', '3000M');
        }

        $request->validate([
            'import_file' => 'required|file|mimes:xls,xlsx'
        ]);

        $path = $request->file('import_file');

        $import = new PreviewImport;

        $import->import($path);

        return response()->json(['excelData' => $import->getData(), 'totalRows' => $import->getTotalRow()], 200);
    }
    public function eidCertificatelist($id)
    {
        $business = Business::find($id);
        $data = array(
            [
                'name' => $business->eid_file_name_attachment,
                'url' => "/storage" . "/" . $business->eid_certificate
            ]
        );
        if (!empty($business)) {
            if ($business->eid_file_name_attachment != null) {
                return response()->json($data, 200);
            }
        }
        return;
    }
    public function checkCategory($bus)
    {
        $businessCategories = FieldValueTranslator::whereNull('deleted_at')->where('table', 'business_category')
            ->where('value', $bus)->orWhere('lang_en', $bus)->orWhere('lang_ko', $bus)->orWhere('lang_jap', $bus)->orderBy('table_id', 'DESC')->first();
        $business = BusinessCategory::whereNull('deleted_at')->where('name', $bus)->first();

        if (!empty($businessCategories)) {
            $res = 'noError';
        } else if (!empty($business)) {
            $res = 'noError';
        } else {
            $res = "hasError";
        }

        return response()->json($res, 200);
    }

    public function previewExcelKeyword(Request $request)
    {
        ini_set('max_execution_time', 3000);
        ini_set('memory_limit', '3000M');

        $request->validate([
            'import_file' => 'required|file|mimes:xls,xlsx'
        ]);

        $path = $request->file('import_file');

        $import = new PreviewBusinessKeywords;

        $import->import($path);

        return response()->json(['excelData' => $import->getData()], 200);
    }

    public function relevance($keyword)
    {
        $getBusinessByRelevance = $this->businessRepository->getBusinessByRelevance($keyword);
    }

    public function exportBusinesskeywords() {
        return Excel::download(new BusinessKeywordExport, 'BusinessKeywords.xlsx');
    }

    public function exportBusinessList() {
        return Excel::download(new BusinessListExportExcel, 'Business.xlsx');
    }

}
