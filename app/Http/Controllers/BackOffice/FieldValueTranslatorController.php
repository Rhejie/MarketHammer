<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Events;
use App\Model\FieldValueTranslator;
use App\Repositories\Translation\FieldValueTranslatorRepository;

class FieldValueTranslatorController extends Controller
{

    public function __construct(FieldValueTranslatorRepository $fieldValueTranslatorRepository)
    {
        $this->fieldValueTranslatorRepository = $fieldValueTranslatorRepository;
    }

    public function store(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            $model = new FieldValueTranslator();
            $model->table = $value['table'];
            $model->field = $value['field'];
            $model->value = $value['value'];
            $model->lang_en = $value['lang_en'];
            $model->lang_ko = $value['lang_ko'];
            $model->lang_jap = $value['lang_jap'];
            $model->save();
        }
        // $material = $this->fieldValueTranslatorRepository->create($request->all());
        // $className = $this->resourceItem();

        // return new $className($material);
    }

    public function show($id)
    {
        $material = $this->fieldValueTranslatorRepository->show($id);
        $className = $this->resourceItem();

        return new $className($material);
    }

    public function update(Request $request, $id)
    {
        $material = $this->fieldValueTranslatorRepository->update($request->all(), $id);
        $className = $this->resourceItem();

        return new $className($material);
    }

    public function destroy($id)
    {
        $material = $this->fieldValueTranslatorRepository->delete($id);
        return $material;
    }

    public function showTrans($table_name)
    {
        $tran = FieldValueTranslator::where('table', $table_name)->get();

        return response()->json($tran, 200);
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\DefaultResource::class;
    }
}
