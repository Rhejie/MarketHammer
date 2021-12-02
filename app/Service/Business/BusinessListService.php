<?php

namespace App\Service\Business;

use Carbon\Carbon;
use App\Model\User;
use App\Model\Plans;
use App\Model\BusinessBanners;
use App\Model\BusinessFiles;
use App\Model\BusinessTags;
use App\Model\IndustryType;
use App\Model\Business;
use App\Model\BusinessAddress;
use App\Model\BusinessOperations;
use App\Model\AssignedCategories;
use App\Model\Bookmarks;

use App\Repositories\Permission\BusinessUserTypePermissionRepository;


/**
 * Repository class. Mainly used for retrieving data from specific storage/module (Business List data).
 * This class should only have functions for retrieving data, process and business logic should be places in Services.
 *
 * @author Chaps
 */
class BusinessListService
{

    public function __construct(BusinessUserTypePermissionRepository $businessUserTypePermissionRepository)
    {
        $this->businessUserTypePermissionRepository = $businessUserTypePermissionRepository;
    }

    public function saveBusinessFromStoreDetails(array $data)
    {
        // dd($data);
        $attributes['businessName'] = $data['businessName'];
        // $attributes['businessAlias'] = $data['businessAlias'];
        $attributes['description'] = $data['description'];
        $attributes['email'] = $data['email'];
        $attributes['phone'] = $data['phone'];
        $attributes['mobile'] = $data['mobile'];
        $attributes['contactPerson'] = $data['contactPerson'];
        $attributes['contactPersonPosition'] = $data['contactPersonPosition'];

        \DB::beginTransaction();
        try {
            $model = new Business;
            $ownerId = null;
            if (isset($data['id']) && $data['id']) {
                $model = Business::find($data['id']);
            }

            $model->fill($attributes);
            $model->userID = $ownerId != null ? $ownerId : auth()->user()->id;

            $validate = $model->validate();
            if (!$validate['success']) {
                return ['success' => false, 'errors' => $validate['errors']];
            }

            $success = $model->save();

            if ($success) {

                //save address
                $addressAttr = [
                    'street' => array_key_exists('street', $data) ? ($data['street'] != '' ? $data['street'] : null) : null,
                    'city' => array_key_exists('city', $data) ? ($data['city'] != '' ? $data['city'] : null) : null,
                    'state' => array_key_exists('state', $data) ? ($data['state'] != '' ? $data['state'] : null) : null,
                    'zip' => array_key_exists('zip', $data) ? ($data['zip'] != '' ? $data['zip'] : null) : null,
                    'countryID' => array_key_exists('countryID', $data) ? ($data['countryID'] != '' ? $data['countryID'] : null) : null,
                    'latitude' => array_key_exists('latitude', $data) ? ($data['latitude'] != '' ? $data['latitude'] : null) : null,
                    'longitude' => array_key_exists('longitude', $data) ? ($data['longitude'] != '' ? $data['longitude'] : null) : null,
                    'buildingNo' => array_key_exists('buildingNo', $data) ? ($data['buildingNo'] != '' ? $data['buildingNo'] : null) : null,
                    'unitNo' => array_key_exists('unitNo', $data) ? ($data['unitNo'] != '' ? $data['unitNo'] : null) : null,
                    'directionDetails' => array_key_exists('directionDetails', $data) ? ($data['directionDetails'] != '' ? $data['directionDetails'] : null) : null,
                    'address2' => array_key_exists('address2', $data) ? ($data['address2'] != '' ? $data['address2'] : null) : null,
                ];

                $addressIsNull = true;
                $address = null;
                $model->businessAddressID = null;
                $model->save();

                foreach ($addressAttr as $key => $index) {
                    if ($key && $index != '') {
                        $addressIsNull = false;
                    }
                }

                if (!$addressIsNull) {
                    $addressID = $model->businessAddressID;
                    $address = $this->saveAddress($addressAttr, $addressID);
                }

                if ($address && !$addressID) {
                    $model->businessAddressID = $address->id;
                }

                $model->save();
                //Business Hours
                $operationHours = $this->saveOperationHours($data['operationHours'], $model->id);
                if (!$operationHours) {
                    $success = false;
                }

                //Save categories
                $categories = $this->saveCategories($data['categories'], $model->id);
                if (!$categories) {
                    $success = false;
                }

                // if (count($data['tags']) > 0) { // save tags
                // 	$this->saveTags($data['tags'], $model->id);
                // }

                if (count($data['banners']) > 0) { // save banners
                    foreach ($data['banners'] as $key => $banner) {
                        $banners = new BusinessBanners;
                        $banners->businessListID = $model->id;
                        $banners->mediaPath = '/storage' . $banner['filePath'];
                        $banners->caption = null;
                        $banners->is_primary = 1;
                        $banners->type = 'image';
                        $banners->save();
                    }
                }

                if (count($data['files']) > 0) { // save files
                    foreach ($data['files'] as $key => $file) {
                        $files = new BusinessFiles;
                        $files->businessListID = $model->id;
                        $files->mediaPath = '/storage' . $file['filePath'];
                        $files->caption = null;
                        $files->type = 'file';
                        $files->save();
                    }
                }

                if (count($data['ids']) > 0) { // save ids
                    foreach ($data['ids'] as $key => $id) {
                        $ids = new BusinessFiles;
                        $ids->businessListID = $model->id;
                        $ids->mediaPath = '/storage' . $id['filePath'];
                        $ids->caption = null;
                        $ids->type = 'id';
                        $ids->save();
                    }
                }

                if ($success) {
                    \DB::commit();
                    return ['success' => true, 'model' => $model];
                }
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        return ['success' => false];
    }

    public function saveBusiness(array $data)
    {
        $attributes = $data;
        $is_updated = false;
        \DB::beginTransaction();
        try {
            $model = new Business;
            $ownerId = null;
            $isNew = true;
            if (isset($data['id']) && $data['id']) {
                $isNew = false;
                $model = Business::find($data['id']);
                $is_updated = true;
            }

            $model->fill($attributes);
            $model->created_at = Carbon::Now();

            $validate = $model->validate();

            if (!$validate) {
                return ['success' => false, 'errors' => $validate['errors']];
            }

            $success = $model->save();

            $model->loadMissing('businessMedias');

            if ($success) {
                if ($isNew) {
                    //Seed default permission on each business
                    $this->businessUserTypePermissionRepository->seedDefaultBusinessPermission($model->id);
                }

                \DB::commit();
                return ['success' => true, 'model' => $model, 'is_updated' => $is_updated];
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        return ['success' => false];
    }

    public function importBusiness(array $data)
    {
        // dd($data['categories']);
        // $attributes['email'] = $data['emailAddress'] != null ? $data['emailAddress'] : null;
        $attributes['joinDate'] = Carbon::now()->toDateString();
        $attributes['clusterID'] = auth()->user()->clusterID;

        $business = Business::where('businessName', $data['businessName'])->first();
        $attributes['businessName'] = $business != null ? $business->businessName . '- Copy' : $data['businessName'];
        $attributes['businessAlias'] = isset($data['businessAlias']) && $data['businessAlias'] != null ? $data['businessAlias'] : null;

        $attributes['businessTypeCode'] = isset($data['businessTypeCode']) && $data['businessTypeCode'] != null ? $data['businessTypeCode'] : null;
        $attributes['kakaoUrl'] = isset($data['kakaoChannelURL']) && $data['kakaoChannelURL'] != null ? $data['kakaoChannelURL'] : null;
        $attributes['blogSite'] = isset($data['blogSite']) && $data['blogSite'] != null ? $data['blogSite'] : null;
        $attributes['mobile'] = isset($data['mobileNumber']) && $data['mobileNumber'] != null ? $data['mobileNumber'] : null;
        $attributes['phone'] = isset($data['phoneNumber']) && $data['phoneNumber'] != null ? $data['phoneNumber'] : null;
        $attributes['contactPerson'] = isset($data['contactPerson']) && $data['contactPerson'] != null ? $data['contactPerson'] : null;
        $attributes['contactPersonPosition'] = isset($data['contactPersonPosition']) && $data['contactPersonPosition'] != null ? $data['contactPersonPosition'] : null;

        \DB::beginTransaction();
        try {
            $model = new Business;
            $ownerId = null;

            $model->fill($attributes);
            $model->userID = $ownerId != null ? $ownerId : auth()->user()->id;
            $model->planID = 0;

            $validate = $model->validate();
            if (!$validate['success']) {
                return ['success' => false, 'errors' => $validate['errors']];
            }

            if (array_key_exists('industryType', $data)) {
                $industry = IndustryType::where('name', $data['industryType'])->first();
                $model->industryTypeID = $industry != null ? $industry->id : 1;
            } else {
                $model->industryTypeID = 1;
            }



            // dd($model);

            $success = $model->save();

            if ($success) {

                //save address
                $addressAttr = [
                    'street' => array_key_exists('streetAddress', $data) ? ($data['streetAddress'] != '' ? $data['streetAddress'] : null) : null,
                    'city' => array_key_exists('city', $data) ? ($data['city'] != '' ? $data['city'] : null) : null,
                    'state' => array_key_exists('state', $data) ? ($data['state'] != '' ? $data['state'] : null) : null,
                    'zip' => array_key_exists('zip', $data) ? ($data['zip'] != '' ? $data['zip'] : null) : null,
                    'unitNo' => array_key_exists('unit#', $data) ? ($data['unit#'] != '' ? $data['unit#'] : null) : null,
                    'buildingNo' => array_key_exists('bldg#', $data) ? ($data['bldg#'] != '' ? $data['bldg#'] : null) : null,
                    'countryID' => auth()->user()->cluster != null ? auth()->user()->cluster->countryID : null,

                    'latitude' => array_key_exists('latitude', $data) ? ($data['latitude'] != '' ? $data['latitude'] : null) : null,
                    'longitude' => array_key_exists('longitude', $data) ? ($data['longitude'] != '' ? $data['longitude'] : null) : null,
                    'directionDetails' => array_key_exists('directionDetails', $data) ? ($data['directionDetails'] != '' ? $data['directionDetails'] : null) : null,
                    'address2' => array_key_exists('address2', $data) ? ($data['address2'] != '' ? $data['address2'] : null) : null,
                ];

                $addressIsNull = true;
                $address = null;
                $model->businessAddressID = null;
                $model->save();

                foreach ($addressAttr as $key => $index) {
                    if ($key && $index != '') {
                        $addressIsNull = false;
                    }
                }

                if (!$addressIsNull) {
                    $addressID = $model->businessAddressID;
                    $address = $this->saveAddress($addressAttr, $addressID);
                }

                if ($address && !$addressID) {
                    $model->businessAddressID = $address->id;
                }

                if (array_key_exists('businessHoursFrom', $data) && array_key_exists('businessHoursTo', $data)) {
                    $operation = new BusinessOperations;
                    $operation->businessListID = $model->id;
                    $operation->from = $data['businessHoursFrom'];
                    $operation->to = $data['businessHoursTo'];
                }

                if (array_key_exists('tags', $data)) {
                    $tag = new BusinessTags;
                    $tag->businessListID = $model->id;
                    $tag->tag = $data['tags'];
                    $tag->save();
                }

                if (array_key_exists('imangeLink', $data)) {
                    $banner = new BusinessBanners;
                    $banner->businessListID = $model->id;
                    $banner->mediaPath = $data['imangeLink'];
                    $banner->save();
                }

                $model->save();

                if ($success) {
                    \DB::commit();
                    return ['success' => true, 'model' => $model];
                }
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        return ['success' => false];
    }

    public function saveAddress(array $data, $id = null)
    {
        $address = new BusinessAddresses;
        if ($id) {
            $address = BusinessAddresses::find($id);
        }
        $address->fill($data);

        if ($address->save()) {
            return $address;
        }

        return false;
    }

    public function saveOperationHours(array $data, $busineeListId)
    {
        $success = true;
        $saved = [];

        foreach ($data as $opKey => $op) {
            if ($op['day'] && $op['from']  && $op['to']) {
                $operation = new BusinessOperations;
                if (isset($op['id']) && $op['id']) {
                    $operation = BusinessOperations::find($op['id']);
                }

                $operation->fill($op);
                $operation->businessListID = $busineeListId;

                if (!$operation->save()) {
                    $success = false;
                } else {
                    array_push($saved, $operation->id);
                }
            }
        }

        //Find existing then remove
        if ($success) {
            $operationList = BusinessOperations::where('businessListID', $busineeListId)->get();
            foreach ($operationList as $key => $op) {
                //If not included in saved. Soft delete
                if (!in_array($op->id, $saved)) {
                    $op->delete();
                }
            }
        }

        return $success;
    }

    /**
     * Save category
     *
     * @param $data <array> array of category id
     * @param $busineeListId <integer>
     *
     * @return <array>
     */
    public function saveCategories(array $data, $businessListID)
    {

        $success = true;
        $saved = [];

        $removedIds = AssignedCategories::whereNotIn('categoryID', $data)->where('businessListID', $businessListID)->pluck('categoryID')->toArray(); // check ids associated from business that are not included (checked from checkbox)

        // delete all categories not included
        $deleteCat = AssignedCategories::whereIn('categoryID', $removedIds)->where('businessListID', $businessListID)->delete();

        foreach ($data as  $cat) {
            $category = AssignedCategories::where(['businessListID' => $businessListID, 'categoryID' => $cat])->first();
            if ($category == null) {
                $category = new AssignedCategories;
                $category->businessListID = $businessListID;
                $category->categoryID = $cat;
            } else {
                $category->deleted_at = null;
            }

            $category->save();
            // if(!$category->save()){
            //       	$success = false;
            //       }
            //       else{
            //       	array_push($saved, $category->id);
            //       }

        }

        //Find existing then remove
        // if($success){
        // 	$categoryList = AssignedCategories::where('businessListID', $businessListID)->get();
        // 	foreach ($categoryList as $key => $cat) {
        // 		//If not included in saved. Soft delete
        // 		if(!in_array($cat->id, $saved)){
        // 			$cat->delete();
        // 		}
        // 	}
        // }

        return $success;
    }

    public function saveTags(array $data, $businesListId)
    {

        $success = true;
        $saved = [];

        foreach ($data as $catKey => $tag) {
            $businesstag = BusinessTags::where(['businessListID' => $businesListId, 'tag' => $tag])->first();
            if ($businesstag == null) {
                $businesstag = new BusinessTags;
                $businesstag->businessListID = $businesListId;
                $businesstag->tag = $tag;
            }
            $businesstag->deleted_at = null;

            if (!$businesstag->save()) {
                $success = false;
            } else {
                array_push($saved, $businesstag->id);
            }
        }

        //Find existing then remove
        if ($success) {
            $tagList = BusinessTags::where('businessListID', $businesListId)->get();
            foreach ($tagList as $key => $tag) {
                //If not included in saved. Soft delete
                if (!in_array($tag->id, $saved)) {
                    $tag->delete();
                }
            }
        }

        return $success;
    }

    /**
     * Save category
     *
     * @param $data <array> array of category id
     * @param $busineeListId <integer>
     *
     * @return <array>
     */
    public function saveBookmark($userID, $businessListID)
    {
        $bookmark = Bookmarks::where(['businessListID' => $businessListID, 'userID' => $userID])->first();
        if ($bookmark == null) {
            $bookmark = new Bookmarks;
            $bookmark->businessListID = $businessListID;
            $bookmark->userID = $userID;

            if ($bookmark->save()) {
                return $bookmark;
            }
        } else {
            if ($bookmark->deleted_at == NULL) {
                if ($bookmark->delete()) {
                    return $bookmark;
                }
            } else {
                $bookmark->deleted_at = null;

                if ($bookmark->save()) {
                    return $bookmark;
                }
            }
        }
        return false;
    }

    /**
     * Update list of social networking sites for the business
     *
     * @param $snsList <array> - sns list
     *
     * @return <boolean>
     */
    public function updateSnsList(array $snsList)
    {
        $ids = array_column($snsList, 'id');

        $snss = \App\Model\Business\BusinessSns::whereIn('id', $ids)->get();

        foreach ($snsList as $sns) {
            $socialNetworking = $snss->first(function ($q) use ($sns) {
                return $q->id == $sns['id'];
            });

            if (!$socialNetworking) continue;

            $socialNetworking->updated_at = __utc_time_now()->format('Y-m-d H:i:s');
            $socialNetworking->account_info = $sns['account_info'];
            $socialNetworking->save();
        }

        return true;
    }

    public function updateBusinessImage(Business $business = null)
    {

        $model = Supplier::find($request->input('id'));
        if ($model) {


            $model->save();

            return ['success' => true, 'data' => $model];
        }


        return ['success' => false, 'code' => 'no_model_found'];
    }
}
