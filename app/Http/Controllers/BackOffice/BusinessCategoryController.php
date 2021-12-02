<?php

namespace App\Http\Controllers\BackOffice;

use App\Helpers\ListHelper;
use App\Http\Controllers\Controller;
use App\Repositories\Category\BusinessCategoryRepository;
use App\Repositories\IndustryType\IndustryTypeRepository;

use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Model\{BusinessCategory, ClusterCategory, FieldValueTranslator};

class BusinessCategoryController extends Controller
{
    use UploadTrait;

    public function __construct(BusinessCategoryRepository $businessCategoryRepository, IndustryTypeRepository $industryTypeRepository)
    {
        $this->middleware(['auth']);
        $this->businessCategoryRepository = $businessCategoryRepository;
        $this->industryTypeRepository = $industryTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search != 'null' && $request->search != '' ? $request->search : null;
        $count = $request->count ? $request->count : 10;


        if (isset($request->search) && isset($request->count)) {
            $params = [
                'count' => $count,
            ];
            $categories = $this->businessCategoryRepository->getCategoryList();
        } else {
            $params = [
                'master_business_category_id' => null,
                'main_business_category_id' => null,
                'sub_business_category_id' => null
            ];
            $categories = $this->businessCategoryRepository->getCategories($params);
        }

        if ($request->ajax()) {
            return response()->json(['categories' => $categories]);
        }

        return view('backoffice.businessCategory.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newCategory = $this->businessCategoryRepository->storeCategory($request->all());

        if (isset($request->clusterId) && $request->clusterId && $newCategory['success']) {
            $clusterCategory = new ClusterCategory;
            $clusterCategory->clusterID = $request->clusterId;
            $clusterCategory->categoryID = $newCategory['data']->id;
            $clusterCategory->save();
        }

        return $newCategory;
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
        $updatedCategory = $this->businessCategoryRepository->updateCategory($id, $request->all());

        return $updatedCategory;
    }

    /*
     * Excel order is [0 = Code, 1 = Name, 2 = Description, 3 = Industry ID, 4 = Master Category, 5 = Main Category, 6 = Sub Business Category]
     */
    public function importCategory(Request $request)
    {

        $post = $request->all();
        $items = $post['body'];
        $header = $post['header'];
        $success = false;
        $data = [];
        $hasError = false;

        try {
            $success = true;
            //Excel order is {0 = name, 1=description}
            foreach ($items as $item) {
                $ko_stat_code = $item[$header[0]];
                //Check if code exist. Do not continue to save data
                $getData = BusinessCategory::where('ko_stat_code', $ko_stat_code)->first();
                if ($getData) {
                    array_push($data, ['row' => $item, 'error' => 'code_exist']);
                    //$hasError = true;
                    continue;
                }

                $params = [
                    'name' => $item[$header[1]],
                    'description' => $item[$header[2]],
                    'ko_stat_code' => $item[$header[0]]
                ];

                $industryType = $item[$header[3]];
                $masterCat = $item[$header[4]];
                $mainCat = $item[$header[5]];
                $subCat = $item[$header[6]];

                //Check if industry exist
                $getIndustry = $this->industryTypeRepository->showIndustryType($industryType);
                if (!$getIndustry) {
                    array_push($data, ['row' => $item, 'error' => 'no_industry']);
                    $hasError = true;
                    continue;
                } else {
                    $params['industry_type_id'] = $getIndustry->id;
                }

                //Check if master cat exist
                if ($masterCat !== "" && $masterCat !== null) {
                    $getMaster = BusinessCategory::where('ko_stat_code', $masterCat)->first();
                    if ($getMaster) {
                        $params['master_business_category_id'] = $getMaster->id;
                    } else {
                        array_push($data, ['row' => $item, 'error' => 'no_master']);
                        $hasError = true;
                        continue;
                    }
                }

                //Check if main cat exist
                if ($mainCat !== "" && $mainCat !== null) {
                    $getMain = BusinessCategory::where('ko_stat_code', $mainCat)->first();
                    if ($getMain) {
                        $params['main_business_category_id'] = $getMain->id;
                    } else {
                        array_push($data, ['row' => $item, 'error' => 'no_main']);
                        $hasError = true;
                        continue;
                    }
                }

                //Check if sub cat exist
                if ($subCat !== "" && $subCat !== null) {
                    $getSub = BusinessCategory::where('ko_stat_code', $subCat)->first();
                    if ($getSub) {
                        $params['sub_business_category_id'] = $getSub->id;
                    } else {
                        array_push($data, ['row' => $item, 'error' => 'no_sub']);
                        $hasError = true;
                        continue;
                    }
                }

                $params = (object) $params;
                $addIndustryType = $this->businessCategoryRepository->storeCategory($params);
            }

            if ($hasError) {
                $success = false;
            }

            if ($success) {
                \DB::commit();
            }
        } catch (\Exception $th) {
            throw $th;
        }

        return response()->json(['success' => $success, 'data' => $data]);
    }

    public function updateImportCategory(Request $request){
        $post = $request->all();
        $items = $post['body'];
        $header = $post['header'];
        $success = false;
        $data = [];
        $hasError = false;

        try {
            $success = true;
            //Excel order is {0 = name, 1=description}
            foreach ($items as $item) {
                $ko_stat_code = $item[$header[0]];
                //Check if code exist. Do not continue to save data
                $getData = BusinessCategory::where('ko_stat_code', $ko_stat_code)->first();
                if ($getData) {
                    $ko = $item[$header[1]];
                    $en = $item[$header[2]];
                    $getData->name = $en;

                    if($getData->save()){

                        //Add translation
                        $translation = FieldValueTranslator::where(['table' => 'business_category', 'table_id' => $getData->id])->first();
                        if(!$translation){
                            $translation = new FieldValueTranslator();
                            $translation->table = 'business_category';
                            $translation->table_id = $getData->id;
                            $translation->created_at = __utc_time_now();
                        }
                        else{
                            $translation->updated_at = __utc_time_now();
                        }
                        $translation->field = 'name';
                        $translation->value = $en;
                        $translation->lang_en = $en;
                        $translation->lang_ko = $ko;

                        $translation->save();
                    }
                
                }
            }
        }
        catch (\Exception $th) {
            throw $th;
        }

        return response()->json(['success' => $success, 'data' => $data]);
    }

    public function saveCategoryFromImport($categoryName, $level, $parentCategoryID = null)
    {
        $category = new Categories;
        $category->name = $categoryName;
        $category->level = $level;
        $category->parentCategoryID = $parentCategoryID;
        $category->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = (new CategoryRepository())->get($id)->loadMissing(['translations']);
        // Page Data
        $PageData = (new CategoryRepository())->getCategoryPageData($category->level);

        return response()->json([
            'category' => $category,
            'PageData' => $PageData
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = BusinessCategory::find($id);

        if ($model) {
            \DB::beginTransaction();
            try {
                //Check if has children
                $getChildren = BusinessCategory::where('master_business_category_id', $id)->orWhere('main_business_category_id', $id)->orWhere('sub_business_category_id', $id)->count();
                if ($getChildren > 0) {
                    return ['success' => false, 'error' => "has_children"];
                }

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

        dd('test');
        $deleteCategory = (new CategoryRepository())->destroyCategory($id);

        return response(null, 204);
    }

    /**
     * Get list of business categories. This function also includes pagination
     * and filtering of data.
     *
     * @return <JSON>
     */
    public function getBusinessCategories(Request $request)
    {
        $searchString = $request->input('searchString');

        $categories = BusinessCategory::where('deleted_at', null)
            ->select()
            ->with(['industryType', 'translations']);

        if ($searchString) {
            $categories->where(function ($q) use ($searchString) {
                $q->where('name', 'like', "%$searchString%");
            });
        }

        $categories = $categories->paginate($request->input('count'));

        return $categories;
    }

    public function uploadImage(Request $request)
    {

        $imageFile = $request->file("file");
        $randomFileName = Str::random(25);

        $folder = '/uploads/images';

        $filePath = $folder . '/' . $randomFileName . '.' . $imageFile->getClientOriginalExtension();

        // Upload image
        $this->uploadOne($imageFile, $folder, 'public', $randomFileName);

        return response()->json(['filepath' => $filePath]);
    }

    public function getIndustryTypesForDropdown(Request $request)
    {
        $industryTypes = (new CategoryRepository())->getIndustryTypeForDropdown($request->searchQuery);

        return response()->json(['industryTypes' => $industryTypes]);
    }

    public function getCategories(Request $request)
    {
        $categories = $this->businessCategoryRepository->getCategories($request);

        return response()->json(['categories' => $categories]);
    }

    public function getParentCategories(Request $request)
    {
        $categories = $this->businessCategoryRepository->getParentCategories();

        return response()->json(['categories' => $categories]);
    }
    public function getParentCategoryTranslation($id)
    { }
}
