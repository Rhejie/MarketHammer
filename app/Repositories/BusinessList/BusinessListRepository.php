<?php

namespace App\Repositories\BusinessList;

use Illuminate\Support\Str;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Model\Business\BusinessMedia;
use App\Model\{Business, BusinessCategory, Clusters, EventMedias, IndustryType};
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;

/**
 * Repository class. Mainly used for retrieving data from specific storage/module (Business List data).
 * This class should only have functions for retrieving data, process and business logic should be places in Services.
 *
 * @author Chaps
 */
class BusinessListRepository extends Repository
{

    public function __construct(Business $model)
    {
        parent::__construct($model);
    }
    use UploadTrait;

    /**
     * Retrieve business list. This mostly use for back office
     *
     * @param $userId <int>
     */
    public function getBusinessList($userId, $params)
    {

        $list = Business::query()->whereNotNull('created_at')
            ->orderBy('business.created_at', 'DESC')
            ->with(['businessMedias', 'businessKeyword', 'translations', 'nda', 'businessCategory']);

        // SEARCH
        if (isset($params->search) && $params->search) {
            $list = $list->where(function ($query) use ($params) {
                $query->where('business.legal_name', 'LIKE', "%$params->search%");
                // $query->orWhere('description', 'LIKE', "%$params->search%");
                $query->orWhere('email', 'LIKE', "%$params->search%");
                $query->orWhere('phone', 'LIKE', "%$params->search%");
                $query->orWhere('created_at', 'LIKE', "%$params->search%");
                $query->orWhere('website', 'LIKE', "%$params->search%");
                $query->orWhere('date_established', 'LIKE', "%$params->search%");
                // $query->orWhere('webAddress', 'LIKE', "%$params->search%");
                // $query->orWhere('businessLicense', 'LIKE', "%$params->search%");
                $query->orWhereHas('businessCategory', function ($query2) use ($params) {
                    $query2->where(function ($query3) use ($params) {
                        $query3->where('name', 'LIKE', "%$params->search%");
                    });
                });
                $query->orWhereHas('businessAddress', function ($query2) use ($params) {
                    $query2->where(function ($query3) use ($params) {
                        $query3->orWhere('city', 'LIKE', "%$params->search%");
                    });
                });
                $query->orWhereHas('industryType', function ($query2) use ($params) {
                    $query2->where(function ($query3) use ($params) {
                        $query3->orWhere('name', 'LIKE', "%$params->search%");
                    });
                });
                $query->orWhereHas('businessKeyword', function ($query2) use ($params) {
                    $query2->where(function ($query3) use ($params) {
                        $query3->orWhere('name', 'LIKE', "%$params->search%");
                    });
                });
            });
        }

        //Do not include if has owner that is a buyer
        $list = $list->where(function ($query) {
            $query->whereHas('owner', function ($query2){
                $query2->where(['user_type_id' => 2]);
            })
            ->orDoesntHave('owner');
        });


        if (isset($params->industry_type_id) && $params->industry_type_id && $params->industry_type_id != "All") {    // Industry Type
            $list = $list->where('industry_type_id', $params->industry_type_id);
            // $list = $list->orWhereHas('industryType', function ($query) use ($params) {
            //     $query->where('id', $params->industry_type_id);
            // });
        }

        if (isset($params->category_id) && $params->category_id && $params->category_id != "All") {    // Category
            $list = $list->where('business_category_id', $params->category_id);
            // $list = $list->orWhereHas('category', function ($query) use ($params) {
            //     $query->where('id', $params->category_id);
            // });
        }

        if (isset($params->country_id) && $params->country_id && $params->country_id != "All") {
            $list = $list->whereHas('businessAddress', function ($query) use ($params) {
                $query->where('country_id', $params->country_id);
                if (isset($params->city) && $params->city && $params->city != "All") {
                    $query->where('city', $params->city);
                }
            });
        }

        // for search histories
        if (isset($params->businessListIds) && $params->businessListIds != []) {
            $list = $list->whereIn('id', $params->businessListIds);
        }

        if (
            isset($params->registered_start) && $params->registered_start && $params->registered_start != "All"
            && isset($params->registered_end) && $params->registered_end && $params->registered_end != "All"
        ) {

            $start = $params->registered_start;
            $end = $params->registered_end;
            if ($start !== 'Invalid date' && $end !== 'Invalid date') {
                $list = $list->whereRaw('created_at BETWEEN "' . $start . '" AND "' . $end . '"');
            }
        }

        if (isset($params->est_min) && $params->est_min) {
            $list = $list->whereRaw("YEAR(Now()) - YEAR(date_established) - (DATE_FORMAT(Now(), '%m%d') < DATE_FORMAT(date_established, '%m%d')) >= " . $params->est_min . "");
        }
        if (isset($params->est_max) && $params->est_max) {
            $list = $list->whereRaw("YEAR(Now()) - YEAR(date_established) - (DATE_FORMAT(Now(), '%m%d') < DATE_FORMAT(date_established, '%m%d')) <= " . $params->est_max . "");
        }

        $current_page = 1;
        if (isset($params->current_page)) {
            $current_page = $params->current_page;
        }

        if (isset($params->count) && $params->count > 0) {
            $list = $list->orderBy('id', "DESC")->paginate($params->count, ['*'], 'page', $current_page);
        } else {
            $list = $list->orderBy('id', "DESC")->get()->toArray();
        }


        return $list;
    }

    public function businessList($params, $paginate = true)
    {

        $list = $this->model()->select(['*']);

        $searchString = isset($params->keyword) && $params->keyword !== null ? $params->keyword : null;

        if ($searchString) {
            $list = $list->where(function ($query) use ($searchString) {
                $query = $query->whereHas('businessKeyword', function ($q) use ($searchString) {
                    $q->where('global_keywords.name', 'like', "%$searchString%");
                    $q->orWhere('global_keywords.lang_ko', 'like', "%$searchString%");
                    $q->orWhere('global_keywords.lang_zh', 'like', "%$searchString%");
                    $q->orWhere('global_keywords.lang_jp', 'like', "%$searchString%");
                    $q->orWhere('global_keywords.lang_de_de', 'like', "%$searchString%");
                });

                $query->orWhereHas('businessCategory', function ($query2) use ($searchString) {
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

                $query = $query->orWhere('legal_name', 'LIKE', "%$searchString%");
            });
        }

        $list = $list->with(['businessProducts' => function ($queryProd) use ($searchString) {
            $queryProd->with(['media'])
                ->where('business_products.is_primary', '=', 1);
        }]);

        //Do not include if has owner that is a buyer
        $list = $list->where(function ($query) {
            $query->whereHas('owner', function ($query2){
                $query2->where(['user_type_id' => 2]);
            })
            ->orDoesntHave('owner');
        });

        if (isset($params->relevance_keyword)) {
            $getBusinessByRelevance = $this->getBusinessByRelevance($params->relevance_keyword);
            //var_dump($getBusinessByRelevance);
            $ids = array();
            $case = '';
            $hasRelevance = false;
            $totalRelevance = 0;
            $totalCount = count($getBusinessByRelevance);
            if ($totalCount > 0) {
                $case = '(CASE ';
                foreach ($getBusinessByRelevance as $key => $value) {
                    $relevance = number_format($value->total_relevance, 2);
                    array_push($ids, $value->id);
                    $case .= 'WHEN business.id = ' . $value->id . ' THEN ' . $relevance . ' ';
                    $totalRelevance += $relevance;
                }
                $case .= 'ELSE 0
                    END) AS relevance_score';

                $list = $list->selectRaw(DB::raw($case));
                $hasRelevance = true;
            }
            $list = $list->addSelect(DB::raw("$totalRelevance AS total_relevance_score"));
            $list = $list->whereIn('id', $ids);
        }

        if (isset($params->logged_user)) {
            $logged_user = $params->logged_user;
            $list = $list->with(['isFollower' => function ($query) use ($logged_user) {
                $query->where(['user_id' => $logged_user]);
            }]);
        }


        if (isset($params->product_keyword)) {
            $product_keyword = $params->product_keyword;


            $list = $list->whereHas('businessProducts', function ($q) use ($product_keyword) {
                $q->where('product.name', 'LIKE', "%$product_keyword%");
            });
        }

        if (isset($params->industry_type_id)) {
            $list = $list->where(['industry_type_id' => $params->industry_type_id]);
        }

        if (isset($params->business_category_id)) {
            $list = $list->where(['business_category_id' => $params->business_category_id]);
        }

        if (isset($params->material_id)) {
            $material_id = is_array($params->material_id) ? $params->material_id : [$params->material_id];
            if (count($material_id) > 0) {
                $list = $list->whereHas('materials', function ($q) use ($material_id) {
                    $q->whereIn('material.id', $material_id);
                });
            }
        }

        if (isset($params->certification_id)) {
            $certification_id = is_array($params->certification_id) ? $params->certification_id : [$params->certification_id];
            if (count($certification_id) > 0) {
                $list = $list->whereHas('certifications', function ($q) use ($certification_id) {
                    $q->whereIn('certification.id', $certification_id);
                });
            }
        }

        if (isset($params->machine_process_type_id)) {
            $machine_process_type_id = is_array($params->machine_process_type_id) ? $params->machine_process_type_id : [$params->machine_process_type_id];
            if (count($machine_process_type_id) > 0) {
                $list = $list->whereHas('machines', function ($q) use ($machine_process_type_id) {
                    $q->whereIn('business_machine.process_type_id', $machine_process_type_id);
                });
            }
        }
        $forFilter = null;
        if(isset($params->get_filter) && $params->get_filter){
            /*For filter result
            ---START--- */
            $forFilter = clone $list;
            $forFilter = $forFilter->select(['business.id', 'business_category_id', 'industry_type_id'])
                ->with(['category' => function ($q) use ($machine_process_type_id) {
                    $q->select('business_category.id', 'business_category.name')->with(['translations']);},
                    'machines:business_machine.id,business_machine.process_type_id',  'certifications:certification.id', 'materials:material.id']);
            $forFilter = $forFilter->get()->toArray();
            /*For filter result
            ---END--- */
        }

        if ($hasRelevance) {
            $list = $list->orderBy('relevance_score', 'DESC');
        }

        $current_page = 1;
        if (isset($params->current_page)) {
            $current_page = $params->current_page;
        }

        $list = $list->with(['category', 'owner', 'businessMedias']);

        if (isset($params->count) && $params->count > 0) {
            $list = $list->orderBy('id', "DESC")->paginate($params->count, ['*'], 'page', $current_page);
        } else {
            if (isset($params->limit) && $params->limit) {
                $list = $list->limit($params->limit);
            }

            $list = $list->get();
        }

        return ['list' => $list, 'filter' => $forFilter] ;
    }

    public function getBusinessData($where, $with = null)
    {

        $businessData = new Business;
        if (!$with) {
            $with = ['businessMedias'];
        }

        if (isset($where['id'])) {
            $businessData = $businessData->where('id', $where['id']);
        }

        if (isset($where['user_id'])) {
            $user_id = $where['user_id'];
            $businessData = $businessData->whereHas('owner', function ($q) use ($user_id) {
                $q->where('user_id', '=', $user_id);
            });
        }


        $businessData = $businessData->with($with)->first();
        //dd($businessData);
        //$businessData = $businessData->with($with)->get()->toArray();

        return $businessData;
    }

    public function getBusiness($id, $with = null)
    {
        if (!$with) {
            $with = ['industryType', 'cluster', 'categories', /*'businessAddress.country',*/ 'businessOperations', 'announcements', 'businessStreams', 'userBookmark', 'businessEvents.eventMedias', 'reviews.banners'];
        }

        $businessData = Business::where('id', $id)
            ->with($with)->first()->toArray();

        return $businessData;
    }

    public function searchBusiness($params, $select)
    {
        $list = $this->model();
        $list = $list->select($select);
        $searchString = isset($params->key) && $params->key !== null ? $params->key : null;

        if ($searchString) {
            $list = $list->where(function ($query) use ($searchString) {
                $query = $query->where('legal_name', 'LIKE', "%$searchString%");
            });
        }

        $list = $list->get();

        return $list;
    }

    // FILTER DROPDOWN SEARCH QUERIES
    public function searchCluster($searchQuery)
    {
        if ($searchQuery && $searchQuery != '') {
            $clusters = Clusters::where(function ($query) use ($searchQuery) {
                $query->orWhere('code', 'LIKE', "%$searchQuery%");
                $query->orWhere('name', 'LIKE', "%$searchQuery%");
            })->paginate(10);
        } else {
            $clusters = Clusters::paginate(10);
        }

        return $clusters;
    }

    public function searchCategory($searchQuery, $filterData = null, $pagination = ['size' => 10])
    {
        $categories = new BusinessCategory;

        if ($searchQuery && $searchQuery != '') {
            $categories = $categories->where('name', 'LIKE', "%$searchQuery%");
        }

        if ($filterData) {
            if (isset($filterData['industry_type_id'])) {
                $industryTypeID = $filterData['industry_type_id'];

                $categories = $categories->where('industry_type_id', $industryTypeID);
            }

            if (isset($filterData['clusterID'])) {
                $clusterID = $filterData['clusterID'];

                $categories = $categories->whereHas('clusterCategory', function ($query) use ($clusterID) {
                    $query->where('clusterID', $clusterID);
                });
            }
        }

        $categories = $categories->localeTranslation();

        if ($pagination) {
            $categories = $categories->paginate($pagination['size']);
        } else {
            $categories = $categories->get()->toArray();
        }

        return $categories;
    }

    public function searchIndustryType($searchQuery, $filterData = null, $pagination = ['size' => 10])
    {

        $industryTypes = new IndustryType;

        if ($searchQuery && $searchQuery != '') {
            $industryTypes = $industryTypes->where(function ($query) use ($searchQuery) {
                $query->orWhere('code', 'LIKE', "%$searchQuery%");
                $query->orWhere('name', 'LIKE', "%$searchQuery%");
            });
        }

        $industryTypes = $industryTypes->localeTranslation();

        if ($pagination) {
            $industryTypes = $industryTypes->paginate($pagination['size']);
        } else {
            $industryTypes = $industryTypes->get();
        }

        return $industryTypes;
    }

    /* public function getBusinessImages($id){
		$banners = BusinessBanners::where(['businessListID' => $id, 'deleted_at' => null])->get();
		$files = [];
		foreach ($banners as $cat) {

			$exists = false;
			if(strpos($cat->mediaPath, 'http') !== false){
				$exists = true;
			}else{
				$exists = Storage::disk('public')->exists(str_replace('/storage','',$cat->mediaPath));
			}
			if($exists){

				$filePath = asset($cat->mediaPath);
				$info = pathinfo($cat->mediaPath);
				$arr = ['details' => $cat,
					'filePath' => $filePath,
					'extension' => isset($info['extension']) ? $info['extension'] : null,
					'filename' => isset($info['filename']) ? $info['filename']: null
				];

				array_push($files, $arr);
			}
		}

		return $files;
	} */

    /* public function importImage($image, $folder = null) {
		$randomFileName = Str::random(25);
		// $originalFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
		$originalFileName = $image->getClientOriginalName();
		$folder = '/uploads/businessbanners';
		$filePath = $folder . '/' . $randomFileName . '.' . $image->getClientOriginalExtension();

		// Upload image
		$this->uploadOne($image, $folder, 'public', $randomFileName);

		$imageFile = [
			'filePath' => $filePath,
			'fileName' => $originalFileName,
			'newFileName' => $randomFileName
		];

		return $imageFile;
	}
 */
    public function importFile($image, $folder = null)
    {
        $randomFileName = Str::random(25);
        // $originalFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $originalFileName = $image->getClientOriginalName();
        $folder = '/uploads/businessfiles';
        $filePath = $folder . '/' . $randomFileName . '.' . $image->getClientOriginalExtension();

        // Upload image
        $this->uploadOne($image, $folder, 'public', $randomFileName);

        $imageFile = [
            'filePath' => $filePath,
            'fileName' => $originalFileName,
            'newFileName' => $randomFileName
        ];

        return $imageFile;
    }

    public function importClaimFile($image, $folder = null)
    {
        $randomFileName = Str::random(25);
        // $originalFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $originalFileName = $image->getClientOriginalName();
        $folder = '/uploads/businessclaimfiles';
        $filePath = $folder . '/' . $randomFileName . '.' . $image->getClientOriginalExtension();

        // Upload image
        $this->uploadOne($image, $folder, 'public', $randomFileName);

        $imageFile = [
            'filePath' => $filePath,
            'fileName' => $originalFileName,
            'newFileName' => $randomFileName
        ];

        return $imageFile;
    }

    /* public function saveBusinessBanners($businessId, $data) {
		// dd($data);
		$fileList = $data['fileList'];
		$isPrimary = isset($data['isPrimary']) ? $data['isPrimary'] : false;
		$saveFile = [];
		$type = $data['type'];
		//Set existing primary to 0
		if($isPrimary){
			$banners = BusinessBanners::where(['businessListID' => $businessId, 'deleted_at' => null, 'is_primary' => 1])->get();
			foreach ($banners as $ban) {
				$ban->is_primary = 0;
				$ban->save();
			}
		}

		$count = 0;
		foreach($fileList as $file) {
			$businessBanner = new BusinessBanners();
			$businessBanner->businessListID = $businessId;
			$businessBanner->mediaPath = '/storage'.$file['filePath'];
			$businessBanner->caption = $file['caption'] ? $file['caption'] : $file['name'];
			$businessBanner->type = $type;
			if($count == 0 && $isPrimary){
				$businessBanner->is_primary = 1;
			}

			if($businessBanner->save()){
				$filePath = asset('/storage'.$file['filePath']);
				$info = pathinfo('/storage'.$file['filePath']);
				$arr = ['details' => $businessBanner,
					'filePath' => $filePath,
					'extension' => $info['extension'],
					'filename' => $info['filename']];

				array_push($saveFile, $arr);
				$count++;
			}
		}
		return $saveFile;
	} */

    public function saveBusinessMedia(array $files, $businessId)
    {
        foreach ($files as $key => $file) {
            $folder = "/uploads/files/business-media/" . $businessId;
            $name = $key . '_' . sha1(time()) . '.' . $file->extension();
            $link = $file->storeAs($folder, $name, 'public');

            $media = new BusinessMedia;
            $media->business_id = $businessId;
            $media->media_type = $file->extension();
            $media->media_url = $link;
            $media->created_at = __utc_time_now()->format('Y-m-d H:i:s');

            $media->save();
        }

        return $this;
    }

    /**
     * Remove business certification media from storage and DB
     *
     * @param $ids <array> - ids of medias
     *
     * @return <self>
     */
    public function deleteBusinessMedias(array $ids)
    {
        $medias = BusinessMedia::whereIn('id', $ids)->get();

        foreach ($medias as $media) {
            // delete old profile
            \Storage::disk('public')->delete($media->media_url);

            $media->forceDelete();
        }

        return $this;
    }

    public function getBusinessByRelevance($keyword)
    {
        $searchableTerm = "";
        if(is_array($keyword)){
            foreach ($keyword as $key => $value) {
               $searchableTerm .= '"'._remove_special_char($value).'" ';
            }
        }
        else{
            //$keyword = _remove_char_with_len($keyword, 3);
            $searchableTerm = _full_text_wildcards($keyword);
        }
        //Define variables used throughout the function
        $selectAll = ['business.id', 'legal_name'];
        $fieldTransSelect = 'fvt.lang_en, fvt.lang_ko, fvt.lang_jap'; //Make sure that all left join for field_value_translator alias 'fvt'

        $b_name_w = 2;
        $b_trans_w = 1.8;
        $b_details_w = 1.5;
        $b_keywords_w = 1.5;
        $b_process_w = 1.5;
        $b_address_w = 1.5;
        $b_others_w = 1;


        //Business Address
        $business_address = $this->model();
        $business_address = $business_address->select($selectAll)
            ->selectRaw("(MATCH(ba.address_line_1, ba.city) AGAINST(? IN BOOLEAN MODE) + MATCH(c.name) AGAINST(? IN BOOLEAN MODE) + MATCH(s.name) AGAINST(? IN BOOLEAN MODE)) * {$b_address_w} AS relevance", [$searchableTerm, $searchableTerm, $searchableTerm])
            ->leftJoin('business_address AS ba', 'business.id', '=', 'ba.business_id')
            ->leftJoin('country AS c', 'c.id', '=', 'ba.country_id')
            ->leftJoin('state AS s', 's.id', '=', 'ba.country_id')
            ->search($searchableTerm, 'ba.address_line_1, ba.city')
            ->search($searchableTerm,  'c.name', true)
            ->search($searchableTerm,  's.name', true);
        //$business_address = $business_address->get()->toArray();


        //Business Address 2
        $business_address_2 = $this->model();
        $business_address_2 = $business_address_2->select($selectAll)
            ->selectRaw("(MATCH(ba.lot_area_size, ba.mfg_area, ba.incidental_area) AGAINST(? IN BOOLEAN MODE) + MATCH(ft.name) AGAINST(? IN BOOLEAN MODE) + MATCH(at.name) AGAINST(? IN BOOLEAN MODE)) * {$b_others_w} AS relevance", [$searchableTerm, $searchableTerm, $searchableTerm])
            ->leftJoin('business_address AS ba', 'business.id', '=', 'ba.business_id')
            ->leftJoin('factory_type AS ft', 'ft.id', '=', 'ba.factory_type_id')
            ->leftJoin('address_type AS at', 'at.id', '=', 'ba.address_type_id')
            ->search($searchableTerm, 'ba.lot_area_size, ba.mfg_area, ba.incidental_area')
            ->search($searchableTerm,  'ft.name', true)
            ->search($searchableTerm,  'at.name', true);
        //$business_address_2 = $business_address_2->get()->toArray();

        //Business Process
        $business_process = $this->model();
        $business_process = $business_process->select($selectAll)
            ->selectRaw("(MATCH(p.name) AGAINST(? IN BOOLEAN MODE) + MATCH({$fieldTransSelect}) AGAINST(? IN BOOLEAN MODE)) * {$b_process_w} AS relevance", [$searchableTerm, $searchableTerm])
            ->leftJoin('business_processes AS bp', 'bp.business_id', '=', 'business.id')
            ->leftJoin('processes AS p', 'p.id', '=', 'bp.processes_id')
            ->leftJoin('field_value_translator AS fvt', function ($join) {
                $join->on('fvt.table_id', '=', 'p.id')->on('fvt.table', '=', DB::raw("'processes'"))->on('fvt.field', '=', DB::raw("'name'"));
            })
            ->search($searchableTerm, 'p.name')
            ->search($searchableTerm, $fieldTransSelect, true);

        /*$business_process = $business_process
            ->union($business_category->getQuery())
            ->getQuery();

        $businessAll = DB::table($business_process)
            ->select(\DB::raw('
                id,
                SUM(relevance) as total_relevance
            '))
            ->groupBy('id')
            ->get();
        var_dump($businessAll);*/

        //Business Keyword
        $business_keyword = $this->model();
        $business_keyword = $business_keyword->select($selectAll)
            ->selectRaw("(MATCH(gk.name, gk.lang_ko, gk.lang_zh, gk.lang_jp, gk.lang_de_de) AGAINST(? IN BOOLEAN MODE)) * {$b_keywords_w} AS relevance", [$searchableTerm])
            ->leftJoin('business_keywords AS bk', 'bk.business_id', '=', 'business.id')
            ->leftJoin('global_keywords AS gk', 'gk.id', '=', 'bk.global_keyword_id')
            ->search($searchableTerm, 'gk.name, gk.lang_ko, gk.lang_zh, gk.lang_jp, gk.lang_de_de');
        //$business_keyword = $business_keyword->get()->toArray();

        //Business Category
        $business_category = $this->model();
        $business_category = $business_category->select($selectAll)
            ->selectRaw("(MATCH(bc.name, bc.description) AGAINST(? IN BOOLEAN MODE) + MATCH({$fieldTransSelect}) AGAINST(? IN BOOLEAN MODE)) * {$b_others_w}  AS relevance", [$searchableTerm, $searchableTerm])
            ->leftJoin('business_category AS bc', 'bc.id', '=', 'business.business_category_id')
            ->leftJoin('field_value_translator AS fvt', function ($join) {
                $join->on('fvt.table_id', '=', 'bc.id')->on('fvt.table', '=', DB::raw("'business_category'"))->on('fvt.field', '=', DB::raw("'name'"));
            })
            ->search($searchableTerm, 'bc.name, bc.description')
            ->search($searchableTerm, $fieldTransSelect, true);
        //$business_category = $business_category->get()->toArray();


        //Business Material
        $business_material = $this->model();
        $business_material = $business_material->select($selectAll)
            ->selectRaw("(MATCH(m.name) AGAINST(? IN BOOLEAN MODE) + MATCH({$fieldTransSelect}) AGAINST(? IN BOOLEAN MODE)) * {$b_others_w}   AS relevance", [$searchableTerm, $searchableTerm])
            ->leftJoin('business_materials AS bm', 'bm.business_id', '=', 'business.id')
            ->leftJoin('material AS m', 'm.id', '=', 'bm.material_id')
            ->leftJoin('field_value_translator AS fvt', function ($join) {
                $join->on('fvt.table_id', '=', 'm.id')->on('fvt.table', '=', DB::raw("'material'"))->on('fvt.field', '=', DB::raw("'name'"));
            })
            ->search($searchableTerm, 'm.name')
            ->search($searchableTerm, $fieldTransSelect, true);
        //$business_material = $business_material->get()->toArray();


        //Business Certification
        $business_certification = $this->model();
        $business_certification = $business_certification->select($selectAll)
            ->selectRaw("(MATCH(bc.name, bc.description, bc.certification_no) AGAINST(? IN BOOLEAN MODE) + MATCH({$fieldTransSelect}) AGAINST(? IN BOOLEAN MODE))  * {$b_others_w}  AS relevance", [$searchableTerm, $searchableTerm])
            ->leftJoin('business_certification AS bc', 'bc.business_id', '=', 'business.id')
            ->leftJoin('field_value_translator AS fvt', function ($join) {
                $join->on('fvt.table_id', '=', 'bc.id')->on('fvt.table', '=', DB::raw("'business_certification'"))->on('fvt.field', '=', DB::raw("'name'"));
            })
            ->search($searchableTerm, 'bc.name, bc.description, bc.certification_no')
            ->search($searchableTerm, $fieldTransSelect, true);
        //$business_certification = $business_certification->get()->toArray();


        //Business Products
        $business_products = $this->model();
        $business_products = $business_products->select($selectAll)
            ->selectRaw("(MATCH(p.name) AGAINST(? IN BOOLEAN MODE) + MATCH({$fieldTransSelect}) AGAINST(? IN BOOLEAN MODE)) * {$b_others_w}  AS relevance", [$searchableTerm, $searchableTerm])
            ->leftJoin('business_products AS bp', 'bp.business_id', '=', 'business.id')
            ->leftJoin('product AS p', 'p.id', '=', 'bp.product_id')
            ->leftJoin('field_value_translator AS fvt', function ($join) {
                $join->on('fvt.table_id', '=', 'p.id')->on('fvt.table', '=', DB::raw("'product'"))->on('fvt.field', '=', DB::raw("'name'"));
            })
            ->search($searchableTerm, 'p.name')
            ->search($searchableTerm, $fieldTransSelect, true);
        //$business_products = $business_products->get()->toArray();


        //Business Contacts
        $business_contact = $this->model();
        $business_contact = $business_contact->select($selectAll)
            ->selectRaw("MATCH(bc.name) AGAINST(? IN BOOLEAN MODE)  * {$b_others_w} AS relevance", [$searchableTerm, $searchableTerm])
            ->leftJoin('business_contact AS bc', 'bc.business_id', '=', 'business.id')
            ->search($searchableTerm, 'bc.name');
        //$business_contact = $business_contact->get()->toArray();

        //Business
        $business = $this->model()->select($selectAll);
        if(!is_array($keyword) && explode(' ', $keyword) > 2){
            $term = _full_text_wildcards($keyword, true);
            //$term = preg_replace('/' . preg_quote('*') . '/', '', $term, 1);

            $words = explode(' ', $term);
            foreach($words as $key => $word) {
                if(strlen($word) == 5) {
                    $words[$key] = str_replace('*', '', $word);
                }
            }
            $termWord = implode( ' ', $words);

            $business = $business->selectRaw("((MATCH(legal_name, english_name, dba) AGAINST(? IN BOOLEAN MODE) + MATCH(legal_name, english_name, dba) AGAINST(? IN BOOLEAN MODE)) * {$b_name_w}) +
                    (MATCH(website, about_us, email, business.phone, fax, eid, corp_ssn) AGAINST(? IN BOOLEAN MODE) * {$b_details_w}) +
                    (MATCH({$fieldTransSelect}) AGAINST(? IN BOOLEAN MODE) * {$b_trans_w})  AS relevance", [$searchableTerm, $termWord, $searchableTerm, $searchableTerm])
                ->leftJoin('field_value_translator AS fvt', function ($join) {
                    $join->on('fvt.table_id', '=', 'business.id')
                        ->on('fvt.table', '=', DB::raw("'business'"))->on('fvt.field', '=', DB::raw("'legal_name'"));
                })
                ->where(function ($query) use ($searchableTerm, $termWord, $fieldTransSelect){
                    $query->search($searchableTerm, 'legal_name, english_name, dba', false, null)
                    ->orWhereRaw("MATCH(legal_name, english_name, dba) AGAINST(? IN BOOLEAN MODE)" , $termWord)
                    ->search($searchableTerm, 'website, about_us, email, business.phone, fax, eid, corp_ssn', true)
                    ->search($searchableTerm, $fieldTransSelect, true);
                });

        }
        else{

            $business = $business->selectRaw("(MATCH(legal_name, english_name, dba) AGAINST(? IN BOOLEAN MODE) * {$b_name_w}) +
                    (MATCH(website, about_us, email, business.phone, fax, eid, corp_ssn) AGAINST(? IN BOOLEAN MODE) * {$b_details_w}) +
                    (MATCH({$fieldTransSelect}) AGAINST(? IN BOOLEAN MODE) * {$b_trans_w})  AS relevance", [$searchableTerm, $searchableTerm, $searchableTerm])
                ->leftJoin('field_value_translator AS fvt', function ($join) {
                    $join->on('fvt.table_id', '=', 'business.id')
                        ->on('fvt.table', '=', DB::raw("'business'"))->on('fvt.field', '=', DB::raw("'legal_name'"));
                })
                ->where(function ($query) use ($searchableTerm, $fieldTransSelect){
                    $query->search($searchableTerm, 'legal_name, english_name, dba', false, null)
                    ->search($searchableTerm, 'website, about_us, email, business.phone, fax, eid, corp_ssn', true)
                    ->search($searchableTerm, $fieldTransSelect, true);
                });
        }

        /*$business = $business->get()->toArray();
        var_dump($business);*/

        $business = $business
            ->union($business_category)
            ->union($business_process)
            ->union($business_category)
            ->union($business_keyword)
            ->union($business_material)
            ->union($business_certification)
            ->union($business_products)
            ->union($business_contact);

        $businessAll = DB::table($business)
            ->select(\DB::raw('
                id,
                SUM(relevance) as total_relevance
            '))
            ->groupBy('id')
            ->orderBy('total_relevance', 'desc')
            ->get()->toArray();
        //var_dump($businessAll);

        return $businessAll;
    }
}
