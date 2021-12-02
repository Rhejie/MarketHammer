<?php

namespace App\Http\Controllers\BackOffice\Setting;

use Illuminate\Http\Request;
use App\Model\Keyword\GlobalKeyword;
use App\Http\Controllers\Controller;
use App\Repositories\Keyword\GlobalKeywordRepository;
use App\Http\Requests\BackOffice\Keyword\{StoreGlobalKeyword, UpdateGlobalKeyword};

class GlobalKeywordController extends Controller
{
    public function __construct(GlobalKeywordRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BackOffice\StoreGlobalKeyword  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGlobalKeyword $request)
    {
        \DB::beginTransaction();
        try {
            $keyword = $this->repository->create($request->all());

            if ($keyword) {
                \DB::commit();

                $className = $this->resourceItem();

                return new $className($keyword);
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
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
        $model = GlobalKeyword::find($id);

        if ($model) {
            \DB::beginTransaction();
            try {
                $translation = $this->repository->update($request->all(), $id);

                if ($translation) {
                    \DB::commit();

                    $className = $this->resourceItem();

                    return new $className($translation);
                }
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $keyword = $this->repository->deleteKeyword($id, $request->input('from'));

        return $keyword;
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\DefaultResource::class;
    }

    /**
     * This method will return the list of queried global keywords
     * This method will also apply search and pagination to the request
     *
     * @param $request <Illuminate\Http\Request>
     *
     * @return <array>
     */
    public function getKeywordList(Request $request)
    {
        $keywords = $this->repository->getKeywordList($request);
        return $keywords;
    }

    public function searchKeywords(Request $request)
    {
        $searchString = $request->input('query');
        $from = $request->input('from');
        $fromId = $request->input('from_id');

        $keywords = GlobalKeyword::select()
            ->where('from_id', null);

        if ($searchString) {
            $keywords->where(function ($q) use ($searchString) {
                $q->where('name', 'like', "%$searchString%");
                $q->orWhere('lang_ko', 'like', "%$searchString%");
                $q->orWhere('lang_zh', 'like', "%$searchString%");
                $q->orWhere('lang_jp', 'like', "%$searchString%");
                $q->orWhere('lang_de_de', 'like', "%$searchString%");
            });
        }

        if ($from) {
            $keywords->whereRaw("NOT EXISTS (SELECT global_keyword_id FROM business_keywords WHERE global_keywords.id = global_keyword_id AND business_id = ? AND deleted_at IS NULL)", [$fromId]);
        }

        return $keywords->limit(100)->get()->toArray();
    }

    public function getKeywords(Request $request)
    {
        $searchString = $request->input('query');

        $business_id = $request->input('business_id');

        $keywords = GlobalKeyword::whereNull('deleted_at')->where('from_id', null)
            ->whereDoesntHave('businesskeywords', function ($q) use ($business_id) {
                $q->where('business_id', $business_id);
            });

        if ($searchString != null) {
            $keywords->where(function ($q) use ($searchString) {
                $q->where('name', 'like', "%$searchString%");
                $q->orWhere('lang_ko', 'like', "%$searchString%");
                $q->orWhere('lang_zh', 'like', "%$searchString%");
                $q->orWhere('lang_jp', 'like', "%$searchString%");
                $q->orWhere('lang_de_de', 'like', "%$searchString%");
            });
        }

        // if ($business_id) {
        //     $keywords->whereRaw(`NOT EXISTS (SELECT global_keyword_id FROM business_keywords WHERE global_keywords.id = global_keyword_id AND business_id = ? AND deleted_at IS NULL)`, [$business_id]);
        // }

        return $keywords->limit(100)->get()->toArray();
    }

    public function getAllKeywords(Request $request) {
        $business_id = $request->input('business_id');
        $keywords = GlobalKeyword::whereNull('deleted_at')->where('from_id', null)
            ->whereDoesntHave('businesskeywords', function ($q) use ($business_id) {
                $q->where('business_id', $business_id);
            });

        return response()->json($keywords, 200);
    }
}
