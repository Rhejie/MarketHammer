<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class APIController extends Controller
{
    protected $repo;
    protected $resource;

    public function __construct($repo)
    {
        $this->repo         = $repo;
    }

    public function getAll(Request $request)
    {
        $result = $this->repo->all();

        $className = $this->resourceCollection();

        return new $className($result);
    }

    public function get(Request $request, $id)
    {
        $result = $this->repo;
        if(isset($request->with)){
            $result = $result->with($request->with);
        }
        $result = $result->where(['id' => $id])->first();

        $className = $this->resourceItem();

        return new $className($result);
    }

    public function paginate(Request $request)
    {
        $result = $this->repo->paginate($request->get('per_page', 20));

        $className = $this->resourceCollection();

        return new $className($result);
    }

    public function create(Request $request, array $data = [])
    {
        $result = $this->repo->create($data);

        $className = $this->resourceItem();

        return new $className($result);
    }

    protected function _save(FormRequest $request)
    {
        $validated = $request->validated();

        $validated = $this->mapAdditionalData($validated);

        $model     = null;
        
        if($request->id) {
            $model = $this->repo->update($validated, $request->id);
        } else {
            $model = $this->repo->create($validated);
        }

        return $model;
    }

    public function _update(FormRequest $request)
    {
        $validated = $request->validated();

        $validated = $this->mapAdditionalData($validated);

        if($request->id) {

            $model = $this->repo->update($validated, $request->id);

            $className = $this->resourceItem();

            return new $className($model);
        }

        return response(null, 404);
    }

    public function remove(Request $request)
    {
        $this->repo->delete($request->id);
        
        return response(null, 204);
    }
    
    protected function mapColumn(string $column)
    {
        return $column;
    }

    protected function mapAdditionalData(array $data): array
    {
        return $data;
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