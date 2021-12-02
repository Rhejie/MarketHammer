<?php

namespace App\Http\Controllers\BackOffice\User;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use App\Http\Requests\BackOffice\User\{StoreUser, UpdateUser};
use App\Model\User\UserBusiness;
use App\Model\UserType;

class UserController extends Controller
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backoffice/user/index', [
            'userTypes' => __get_user_types()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $attributes = $request->all();

        \DB::enableQueryLog();

        \DB::beginTransaction();
        try {
            $user = $this->repository->create($attributes);

            if ($user) {
                \DB::commit();
                if ($request->supplier_id != null) {
                    UserBusiness::create(['user_id' => $user->id, 'business_id' => $request->supplier_id]);


                    $user = User::where('id', $user->id)->select()->displayName()->with(['userType', 'userBusiness'])->first();
                } else {
                    $user = User::where('id', $user->id)->select()->displayName()->with(['userType'])->first();
                }

                $className = $this->resourceItem();

                return new $className($user);
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function update(UpdateUser $request, $id)
    {
        $attributes = $request->all();

        \DB::beginTransaction();
        try {
            $user = $this->repository->update($attributes, $id);

            if ($request->supplier_id == null) {
                $userB = UserBusiness::where('user_id', $id);
                $userB->delete();
            }

            if ($user) {
                \DB::commit();

                UserBusiness::where('user_id', $user->id)->update(['business_id' => $request->supplier_id]);

                $user = User::where('id', $user->id)->select()->displayName()->with('userType', 'userBusiness')->first();


                $className = $this->resourceItem();

                return new $className($user);
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userB = UserBusiness::where('user_id', $id)->first();
        if (!empty($userB)) {
            $userB->delete();
        }
        $user = $this->repository->delete($id);

        return $user;
    }

    /**
     * Retrieve list of business addresses
     *
     * @param $request <Request>
     *
     * @return <array>
     */
    public function getUsers(Request $request)
    {
        $searchString = $request->input('searchString');
        $userType = $request->input('userType');

        $users = $this->repository->model()->select()->displayName()
            ->with(['userType', 'userBusiness']);

        if ($searchString) {
            $users = $users->where(function ($q) use ($searchString) {
                $q->where('first_name', 'like', "%$searchString%");
                $q->orWhere('last_name', 'like', "%$searchString%");
                $q->orWhere('email', 'like', "%$searchString%");
                $q->orWhere(\DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%$searchString%");
                $q->orWhere(\DB::raw("CONCAT(first_name, last_name)"), 'like', "%$searchString%");
            });
        }

        if ($userType) {
            $users = $users->where('user_type_id', $userType);
        }

        $users = $users->paginate($request->input('size'));

        return $users;
    }

    /**
     * API endpoint in setting/changing the user's locale
     *
     * @param $request <Request>
     *
     * @return <boolean>
     */
    public function setUserLocale(Request $request)
    {
        return $this->repository->setUserLocale($request->input('locale'));
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\User\UserResource::class;
    }

    public function getSupplier($query)
    {
        return response()->json(['suppliers' => ___get_suppliers($query)], 200);
    }
    public function checkUserType($id)
    {

        $users = UserType::find($id);

        return response()->json([
            'user_type' => $users->code
        ], 200);
    }

    public function getUser($id) {
        $user = User::find($id);

        return response()->json($user, 200);
    }
}
