<?php

namespace App\Http\Controllers\API\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \DB;
use Dotenv\Regex\Success;
use App\Repositories\Product\ProductKeywordRepository;
use App\Repositories\Product\ProductRepository;

class ProductController extends Controller
{

    public function __construct(ProductRepository $repo, ProductKeywordRepository $productKeywordRepository)
    {
        $this->repo = $repo;
        $this->productKeywordRepository = $productKeywordRepository;

    }

    public function getAll(Request $request)
    {
        $result = $this->repo->productList($request, true);

        $className = $this->resourceCollection();

        return new $className($result);
    }

    public function get(Request $request, $id)
    {
        $result = $this->repo->get($id);

        $className = $this->resourceItem();

        return new $className($result);
    }

    public function getKeywords(Request $request)
    {
        $keywords = $this->productKeywordRepository->getKeywords($request, null, ['id', 'name', DB::raw("'Keyword' as key_type")]);

        $className = $this->resourceCollection();
        return new $className($keywords);
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\DefaultResource::class;
    }

    protected function resourceCollection(): string
    {
        return \App\Http\Resources\DefaultCollection::class;
    }
}
