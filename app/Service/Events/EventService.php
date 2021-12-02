<?php

namespace App\Service\Events;

use App\Model\EventMedias;

/**
 * Helper class for managing events.
 * Functions concerning events should be place here.
 *
 * @author Chap
 */

class EventService 
{
	/**
     * Save event files
     *
     * @param $medias <array> - array of files uploaded
     * @param $eventId <strgin> - the parent event
     *
     * @return <array>
     */
    public function saveFiles(Array $medias, $eventId)
    {
        $folder = "/uploads/images/events/$eventId";
        $savedFiles = [];

        foreach ($medias as $media) {
            $savedFiles[] = $media->storeAs($folder, $media->getClientOriginalName(), 'public');
        }

        return $savedFiles;
    }

    /**
	 * Create event medias.
	 *
	 * @param $links <array> - list of saved files' symlinks
	 * @param $eventId <string>
	 *
	 * @return <array>
     */
    public function saveEventMedias(Array $links, $eventId)
    {
    	foreach ($links as $link) {
    		$model = new EventMedias;
    		$model->eventID = $eventId;
    		$model->mediaPath = $link;
    		$model->created_at = auth()->user()->utcTimeNow();

    		if (!$model->validate()) return ['success' => false, 'errors' => $model->errors];

    		$model->save();
    	}

    	return ['success' => true];
    }

    /**
	 * Delete event medias
	 *
	 * @param $medias <array> - array if medias
	 *
	 * @return <array>
     */
    public function deleteEventMedias($medias)
    {
    	$storage = new \Illuminate\Support\Facades\Storage();
    	foreach ($medias as $media) {
			$model = EventMedias::find($media['id']);

			if ($model && $model->delete()) {
				$delete = $storage::disk('public')->delete($model->mediaPath);
			}
    	}

    	return ['success' => true];
    }
}