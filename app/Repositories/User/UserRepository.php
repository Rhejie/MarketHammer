<?php

namespace App\Repositories\User;

use App\Model\User;
use Illuminate\Support\Str;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\{File, Route, Storage};
use App\Repositories\Repository;

/**
 * Repository class. Mainly used for retrieving data from specific storage/module (Business List data).
 * This class should only have functions for retrieving data, process and business logic should be places in Services.
 *
 * @author Chaps
 */
class UserRepository extends Repository
{

    use UploadTrait;
    /**
     * Retrieve business list. This mostly use for back office
     *
     * @param $userId <int>
     */

    /**
     * Instancetiate the class.
     *
     * @param $model <BusinessCertification> - the model class that this repository will be handling
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function importImage($image, $folder = null)
    {
        $randomFileName = Str::random(25);
        // $originalFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $originalFileName = $image->getClientOriginalName();
        $folder = '/uploads/users';
        $filePath = $folder . '/' . $randomFileName . '.' . $image->getClientOriginalExtension();

        // Upload image
        $upload = $this->uploadOne($image, $folder, 'public', $randomFileName);

        $imageFile = [
            'filePath' => $filePath,
            'fileName' => $originalFileName,
            'newFileName' => $randomFileName
        ];

        if ($upload) {
            $user = User::find(auth()->id());
            $user->imagePath = $filePath;
            $user->save();
        }

        //filepath

        return $imageFile;
    }

    public function saveBusinessBanners($businessId, $data)
    {
        $fileList = $data['fileList'];
        $isPrimary = isset($data['isPrimary']) ? $data['isPrimary'] : false;
        $saveFile = [];
        $type = $data['type'];
        //Set existing primary to 0
        if ($isPrimary) {
            $banners = BusinessBanners::where(['businessListID' => $businessId, 'deleted_at' => null, 'is_primary' => 1])->get();
            foreach ($banners as $ban) {
                $ban->is_primary = 0;
                $ban->save();
            }
        }

        $count = 0;
        foreach ($fileList as $file) {
            $businessBanner = new BusinessBanners();
            $businessBanner->businessListID = $businessId;
            $businessBanner->mediaPath = '/storage' . $file['filePath'];
            $businessBanner->caption = $file['caption'] ? $file['caption'] : $file['name'];
            $businessBanner->type = $type;
            if ($count == 0 && $isPrimary) {
                $businessBanner->is_primary = 1;
            }

            if ($businessBanner->save()) {
                $filePath = asset('/storage' . $file['filePath']);
                $info = pathinfo('/storage' . $file['filePath']);
                $arr = [
                    'details' => $businessBanner,
                    'filePath' => $filePath,
                    'extension' => $info['extension'],
                    'filename' => $info['filename']
                ];

                array_push($saveFile, $arr);
                $count++;
            }
        }

        return $saveFile;
    }

    /**
     * Set or change the user's locale
     *
     * @param $locale <string> - the language code
     *
     * @return <boolean>
     */
    public function setUserLocale($locale)
    {
        $model = User::find(auth()->user()->id);
        $model->language = $locale;

        return $model->save();
    }
}
