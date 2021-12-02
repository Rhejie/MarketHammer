<?php

namespace App\Repositories\Business;

use App\Model\Certification;
use App\Repositories\Repository;
use App\Model\Business\{BusinessCertification, BusinessCertificationMedia};

class BusinessCertificationRepository extends Repository
{
	/**
     * Instancetiate the class.
     *
     * @param $model <BusinessCertification> - the model class that this repository will be handling
     */
    public function __construct(BusinessCertification $model)
    {
        parent::__construct($model);
    }

	/**
	 * Retrieve list of certifications.
	 *
	 * @param $select <string | array> - if present, override default select statement
	 *
	 * @return <array>
	 */
	public static function getCertifications($select = null)
	{
		$certifications = Certification::select([
			'id', 
			'certification_type_id', 
			'name', 
			'description' 
		])
		->selectRaw('CONVERT_TZ(created_at, "+00:00", ?) as created_at', [date('P')]);

		if ($select) {
			$certifications = $certifications->select($select);
		}

		$certifications = $certifications->localeTranslation()->get()->toArray();

		return $certifications;
	}

	/**
	 * This will handle saving of business certification medias.
	 * Every time this method is called, it will delete the old certification medias 
	 * of the passed business certification id and replaced it with the new ones.
	 *
	 * @param $files <array> - array of files to be saved
	 * @param $id <string> - the business certification id
	 *
	 * @return <self>
	 */
	public function saveNewCertificationMedias(Array $files, $id)
	{
		foreach ($files as $key => $file) {
            $folder = "/uploads/files/business-certifications/" . $id;
            $name = $key . '_' . sha1(time()) . '.' . $file->extension();
            $link = $file->storeAs($folder, $name, 'public');

            $media = new BusinessCertificationMedia;
            $media->business_certification_id = $id;
            $media->media_type = $file->extension();
            $media->media_url = $link;
            $media->created_at = __utc_time_now()->format('Y-m-d H:i:s');

            $media->save();
        }

        return $this;
	}

	/**
	 * Remove all business certification medias
	 *
	 * @param $id <string> - the business certifications media
	 *
	 * @return <self>
	 */
	public function deleteAllCertificationMedias($id)
	{
		$medias = BusinessCertificationMedia::where('business_certification_id', $id)->get();

		foreach ($medias as $media) {
			// delete old profile
        	\Storage::disk('public')->delete($media->media_url);
        	
        	$media->forceDelete();
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
	public function deleteCertificationMedias(array $ids)
	{
		$medias = BusinessCertificationMedia::whereIn('id', $ids)->get();

		foreach ($medias as $media) {
			// delete old profile
        	\Storage::disk('public')->delete($media->media_url);
        	
        	$media->forceDelete();
		}

		return $this;
	}

	/**
	 * Delete a directory where all the business directory mediay is located
	 *
	 * @param $id <string> - the business certification id
	 */
	public function deleteFolder($id)
	{
		BusinessCertificationMedia::where('business_certification_id', $id)->delete();

		$folder = "public/uploads/files/business-certifications/" . $id;

		$deleted = \Storage::deleteDirectory($folder);
	}
}