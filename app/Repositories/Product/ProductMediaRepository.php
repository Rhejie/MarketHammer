<?php

namespace App\Repositories\Product;

use Illuminate\Support\Str;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Model\ProductMedia;
use App\Repositories\Repository;

/**
 * Repository class. Mainly used for retrieving data from specific storage/module (Business List data).
 * This class should only have functions for retrieving data, process and business logic should be places in Services.
 *
 * @author Chaps
 */
class ProductMediaRepository extends Repository
{
    use UploadTrait;

    public function __construct(ProductMedia $model)
    {
        parent::__construct($model);
    }

    public function save($file, $productId)
    {
    	$folder = "/uploads/files/product-media/" . $productId;
    	$randName = sha1(time() .''. rand());
        $name = sha1(time() .''.$randName) . '.' . $file->extension();
        $link = $file->storeAs($folder, $name, 'public');

        $media = $this->model();
        $media->product_id = $productId;
        $media->media_type = $file->extension();
        $media->media_url = $link;
        $media->created_at = __utc_time_now()->format('Y-m-d H:i:s');

        $media->save();
        

        return $media;
    }

    /**
     * Remove business certification media from storage and DB
     *
     * @param $ids <array> - ids of medias
     *
     * @return <self>
     */
    public function remove($id)
    {
    	$media = $this->get($id);
        if($media){
        	\Storage::disk('public')->delete($media->media_url);
        	$media->forceDelete();
        }

        return $id;
    }
}