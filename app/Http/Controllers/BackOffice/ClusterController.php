<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackOffice\Cluster\StoreClusterRequest;
use App\Http\Requests\BackOffice\Cluster\UpdateClusterRequest;
use App\Model\Clusters;
use App\Repositories\Cluster\ClusterRepository;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Http\Request;

class ClusterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = [
            'count' => $request->count ? $request->count : 10,
            'search' => $request->search ? $request->search : null
        ];

        $clusters = (new ClusterRepository())->getClusters(json_decode(json_encode($params)));
        
        if($request->ajax()) {
            return response()->json(['clusters' => $clusters]);
        }

        return view('backoffice.cluster.index', compact('clusters'));
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
    public function store(StoreClusterRequest $request)
    {
        $newCluster = (new ClusterRepository())->storeCluster(json_decode(json_encode($request->all())));

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
        $cluster = (new ClusterRepository())->showCluster($id);

        return response()->json(['cluster' => $cluster]);
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
    public function update(UpdateClusterRequest $request, $id)
    {
        // dd($request->all());
        $updatedCluster = (new ClusterRepository())->updateCluster($id, json_decode(json_encode($request->all())));

        return response()->json(['cluster' => $updatedCluster]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::beginTransaction();
        try {
            $deleteCluster = (new ClusterRepository())->destroyCluster($id);

            \DB::commit();
        } catch (\Exception $th) {
            \DB::rollback();
            throw $th;
        }

        return response(null, 204);
    }

    public function getThemesDropdown(Request $request) {
        $themes = (new ClusterRepository())->getThemesForDropdown($request->searchQuery);
        
        return response()->json(['themes' => $themes]);
    }

    public function getCategoriesDropdownById(Request $request) {
        // dd($request->id);
        $categories = (new ClusterRepository())->getCategoriesForDropdownById($request->id);

        foreach ($categories as $category) {
            // ids of child categories associated with the cluster
            $clusterChildrenCategoryIds = (new ClusterRepository())->getclusterChildrenCategoryIds($category->id,$request->id)->pluck('id')->toArray();
            
            if (count($clusterChildrenCategoryIds) > 0) {
                $children = (new CategoryRepository())->getCategoryChildren($clusterChildrenCategoryIds);
                $category->children = $children;
            } else {
                $category->children = [];
            }
        }
         

        // dd($categories);
        return response()->json(['categories' => $categories]);
    }

    public function getCategoriesDropdown(Request $request) {
        // dd($request->all());
        $categories = (new ClusterRepository())->getCategoriesForDropdown($request->searchQuery, $request->id);
        // dd($categories[0]->parent);

        $parents = [];
        foreach ($categories as $category) {
            // ids of child categories associated with the cluster
            $clusterChildrenCategoryIds = (new ClusterRepository())->getclusterChildrenCategoryIdsByQuery($category->id, $request->id, $request->searchQuery)->pluck('id')->toArray();
            // dd($clusterChildrenCategoryIds);
            if (count($clusterChildrenCategoryIds) > 0) {
                $children = (new CategoryRepository())->getCategoryChildren($clusterChildrenCategoryIds);
                $category->children = $children;
            } else {
                $category->children = [];
            }

            if ($category->parent != null) {
                $parents[] = $category->parent;
            }
        }
        // dd(count($parents));
        if (count($parents) > 0) {

            foreach ($parents as $parent) {
                // ids of child categories associated with the cluster
                $clusterChildrenCategoryIds = (new ClusterRepository())->getclusterChildrenCategoryIdsByQuery($parent->id, $request->id, $request->searchQuery)->pluck('id')->toArray();
                // dd($clusterChildrenCategoryIds);
                if (count($clusterChildrenCategoryIds) > 0) {
                    $children = (new CategoryRepository())->getCategoryChildren($clusterChildrenCategoryIds);
                    $parent->children = $children;
                } else {
                    $parent->children = [];
                }
            }

            $parents = collect($parents);
            // dd($categories->merge($parents));
            $categories = $categories->merge($parents);   
        }
        // dd($categories);
        return response()->json(['categories' => $categories]);
    }

    public function getAllCategoriesForDropdown(Request $request) {
        // dd($request->all());
        $categories = (new ClusterRepository())->getAllCategoriesForDropdown($request->searchQuery);
        // dd($categories[0]->parent);

        $parents = [];
        foreach ($categories as $category) {
            // ids of child categories associated with the cluster
 
            if ($category->children != null) {
                $category->children = $category->children;
            } else {
                $category->children = [];
            }

        }
        
        return response()->json(['categories' => $categories]);
    }
    
    public function getCountriesDropdown(Request $request) {
        $countries = (new ClusterRepository())->getCountriesForDropdown($request->searchQuery);

        return response()->json(['countries' => $countries]);
    }
}
