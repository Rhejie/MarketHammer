<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
	 * The repository class that a controller will be using
	 *
	 * @var <App\Repositories> - should an instance of a class from the given namespace
     */
    protected $repository;

    /**
	 * The default resource for single model
	 *
	 * @return <String>
     */
    protected function resourceItem(): string
    {
        return \App\Http\Resources\DefaultResource::class;
    }
}
