<?php

namespace App\Repositories\Keyword;

use App\Repositories\Repository;
use App\Model\Keyword\{GlobalKeyword, BusinessKeyword};

class GlobalKeywordRepository extends Repository
{
    public function __construct(GlobalKeyword $model)
    {
        parent::__construct($model);
    }

    /**
     * Override parent create functionality.
     *
     * @param $data <array> - post inforation
     *
     * @return <object || boolean>
     */
    public function create(array $data)
    {
        \DB::beginTransaction();
        try {
            if ($data['id']) {
                $this->setBusinessLink($data['id'], $data['from_id']);

                \DB::commit();

                return $this->get($data['id']);
            } else {
                $model = $this->model;
                $model->fill($data);

                if ($model->save()) {
                    if ($model->from_id) {
                        $this->setBusinessLink($model->id, $model->from_id);
                    }

                    \DB::commit();

                    return $this->get($model->id);
                }
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        return false;
    }

    public function deleteKeyword($id, $from)
    {
        $deleted = false;

        if ($from === 'global') {
            $deleted = $this->delete($id);
        } else if ($from === 'business') {
            $bsKeyword = BusinessKeyword::find($id);
            $keyword = GlobalKeyword::where(['from' => $from, 'from_id' => $bsKeyword->business_id]);

            $deleted = BusinessKeyword::find($id)->delete();

            if ($keyword) {
                $keyword->delete();
            }
        }

        return $deleted;
    }

    public function setBusinessLink($keywordId, $businessId)
    {
        $model = new BusinessKeyword;
        $model->business_id = $businessId;
        $model->global_keyword_id = $keywordId;

        return $model->save();
    }

    public function getKeywordList($request, $select = null)
    {

        $searchString = $request->input('searchString');
        $from = $request->input('from');
        $fromId = $request->input('from_id');

        $searchString = isset($request->key) && $request->key !== null ? $request->key : $searchString;

        $keywords = $this->model();
        if ($select) {
            $keywords = $keywords->select($select);
        }

        if ($searchString) {
            $keywords = $keywords->where(function ($q) use ($searchString) {
                $q->where('name', 'like', "%$searchString%");
                $q->orWhere('lang_ko', 'like', "%$searchString%");
                $q->orWhere('lang_zh', 'like', "%$searchString%");
                $q->orWhere('lang_jp', 'like', "%$searchString%");
                $q->orWhere('lang_de_de', 'like', "%$searchString%");
            });
        }

        if ($from === 'business') {
            $keywords = $keywords->join('business_keywords', function ($join) use ($fromId) {
                $join->on('global_keywords.id', '=', 'business_keywords.global_keyword_id')
                    ->where('business_keywords.deleted_at', null)
                    ->where('business_keywords.business_id', $fromId);
            })
                ->addSelect(['business_keywords.id as business_keyword_id']);
        }

        $keywords = $keywords->orderBy('created_by', 'DESC');

        if ($request->input('size')) {
            $keywords = $keywords->paginate($request->input('size'));
        } else {
            $keywords = $keywords->get();
        }

        return $keywords;
    }
}
