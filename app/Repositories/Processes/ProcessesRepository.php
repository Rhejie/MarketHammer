<?php

namespace App\Repositories\Processes;

use App\Repositories\Repository;

use App\Model\Processes;

class ProcessesRepository extends Repository
{
    public function __construct(Processes $model)
    {
        parent::__construct($model);
    }

    public function getProcessesList($params)
    {
        if ($params->search) {
            $processes = $this->model()->where(function ($query) use ($params) {
                // $query->orWhere('code', 'LIKE', "%$params->search%");
                $query->orWhere('name', 'LIKE', "%$params->search%");
            })->with(['processType' => function ($query){
                    $query->with(['translations']);
                }, 'translations'])->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        } else {
            $processes = $this->model()->with(['processType' => function ($query){
                    $query->with(['translations']);
                }, 'translations'])->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        }

        return $processes;
    }

    public function store($params)
    {

        $process = Processes::create([
            'process_type_id' => $params->process_type_id,
            'name' => $params->name,
            'description' => $params->description
        ]);

        if ($process) {
            if ($this->hasTranslationData()) {
                $this->storeFieldTranslations($process);
            }
        }

        $processes = Processes::with(['processType' => function($query) {$query->with('translations');}])->find($process->id)->loadMissing(['translations']);

        return $processes;
    }

    public function update($id, $params)
    {

        $process = Processes::find($id);
        $process->update([
            'process_type_id' => $params->process_type_id,
            'name' => $params->name,
            'description' => $params->description
        ]);

        if ($process) {
            if ($this->hasTranslationData()) {
                $this->updateFieldTranslations($process);
            }
        }

        $proc = Processes::with('processType')->find($id);

        return $proc->loadMissing(['translations']);
    }
}
