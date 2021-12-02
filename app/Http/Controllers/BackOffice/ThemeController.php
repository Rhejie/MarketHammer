<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackOffice\Theme\StoreThemeRequest;
use App\Http\Requests\BackOffice\Theme\UpdateThemeRequest;
use App\Repositories\Theme\ThemeRepository;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $count = $request->count ? $request->count : 10;
        $search = $request->search && $request->search != '' ? $request->search : null;

        $params = [
            'count' => $count,
            'search' => $search
        ];

        $themes = (new ThemeRepository())->getThemeList(json_decode(json_encode($params)));

        if($request->ajax()) {
            return response()->json(['themes' => $themes]);
        }

        return view('backoffice.theme.index', compact('themes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreThemeRequest $request)
    {
        $newTheme = (new ThemeRepository())->storeTheme(json_decode(json_encode($request->all())));

        return response(null, 204);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $theme = (new ThemeRepository())->showTheme($id);

        return response()->json(['theme' => $theme]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateThemeRequest $request, $id)
    {
        $updatedTheme = (new ThemeRepository())->updateTheme($id, json_decode(json_encode($request->all())));

        return response(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroyTheme = (new ThemeRepository())->destroyTheme($id);

        return response(null, 204);
    }
}
