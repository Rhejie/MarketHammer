<?php

namespace App\Http\Controllers\Auth;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use \App\Repositories\User\UserRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Business\BusinessProductRepository;
use App\Repositories\Business\BusinessCertificationRepository;
use \App\Service\Business\BusinessListService;

use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/email/verify';

    /**
     * The abstraction layer for the business repository module
     *
     * @var BusinessCertificationRepository
     */
    private $userRepository;

    /**
     * The abstraction layer for the business repository module
     *
     * @var BusinessCertificationRepository
     */
    private $businessService;

    /**
     * The abstraction layer for the business repository module
     *
     * @var BusinessCertificationRepository
     */
    private $businessCertificationRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserRepository $userRepository,
        BusinessCertificationRepository $businessCertification,
        ProductRepository $productRepository,
        BusinessProductRepository $businessProductRepository,
        BusinessListService $businessService

    ) {
        $this->middleware('guest');

        $this->userRepository = $userRepository;

        $this->businessService = $businessService;

        $this->businessCertificationRepository = $businessCertification;

        $this->productRepository = $productRepository;

        $this->businessProductRepository = $businessProductRepository;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Model\User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstName' => $data['first_name'],
            'lastName' => $data['last_name'],
            'phone' => $data['contact_no'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegistrationForm() 
    {
        return view('auth.register', [
            'userTypes' => __get_user_types(),
            'industryTypes' => __get_industry_types(),
            'businessCategories' => __get_business_categories(['id', 'name', 'description', 'industry_type_id', 'ko_stat_code']),
            'employeeCounts' => __get_employee_counts(),
            'certifications' => \App\Repositories\Business\BusinessCertificationRepository::getCertifications()
        ]);
    }

    public function verifyEmail() {
        
        return view('auth.verify');
    }

    public function registerSupplier(Request $request)
    {
        $userAttributes['first_name'] = strtolower($request->input('first_name'));
        $userAttributes['last_name'] = strtolower(__is_null_undefined($request->input('last_name')));
        $userAttributes['phone'] = __is_null_undefined($request->input('phone'));
        $userAttributes['user_type_id'] = $request->input('user_type_id');
        $userAttributes['birth_day'] = __is_null_undefined($request->input('birth_day'));
        $userAttributes['email'] = $request->input('email');
        $userAttributes['password'] = bcrypt(12341234);
        $userAttributes['created_at'] = __utc_time_now();
        $userAttributes['is_confirmed'] = 1;
        $userAttributes['created_from_social'] = 'regular';

        $certifications = $request->input('certifications');
        $products = $request->input('products');
        $supplier = $request->input('supplierData');

        \DB::beginTransaction();
        try {
            $user = new \App\Model\User;
            $user->fill($userAttributes);
            if (!$user->validate()) {
                return response($user->errors, 422);
            }

            $user = $this->userRepository->create($userAttributes);

            if ($user) {
                $businessAttributes = $supplier;
                $businessAttributes['english_name'] = __is_null_undefined($supplier['english_name']);
                $businessAttributes['rnd_staff_count_id'] = json_decode($supplier['rnd_staff_count_id']);
                $businessAttributes['date_established'] = __is_null_undefined($supplier['date_established']);
                $businessAttributes['website'] = __is_null_undefined($supplier['website']);
                $businessAttributes['eid_certificate'] = __is_null_undefined($supplier['eid_certificate']);
                $businessAttributes['created_at'] = __utc_time_now();
                $businessAttributes['status'] = 'public';

                $businessModel = new \App\Model\Business;
                $businessModel->fill($businessAttributes);
                if (!$businessModel->validate()) {
                    return response($businessModel->errors, 422);
                }

                $business = $this->businessService->saveBusiness($businessAttributes);

                if ($business['success']) {
                    if ($certifications) {
                        $certFiles = $request->file('certifications');

                        foreach ($certifications as $key => $cert) {
                            $files = isset($certFiles[$key]) ? $certFiles[$key] : []; 
                            
                            $certAttributes['certification_id'] = json_decode($cert['certification_id']); 
                            $certAttributes['certification_no'] = json_decode($cert['certification_no']); 
                            $certAttributes['name'] = strtolower($cert['name']);
                            $certAttributes['description'] = __is_null_undefined($cert['description']); 
                            $certAttributes['is_verified'] = json_decode($cert['is_verified']); 
                            $certAttributes['issued_date'] = __is_null_undefined($cert['issued_date']);
                            $certAttributes['expiry_date'] = __is_null_undefined($cert['expiry_date']);
                            $certAttributes['business_id'] = $business['model']->id;

                            $certification = $this->businessCertificationRepository->create($certAttributes);

                            if ($files) {
                                $medias = $this->businessCertificationRepository->saveNewCertificationMedias($files['files'], $certification->id);
                            }
                        }
                    }

                    if ($products) {
                        foreach ($products as $prod) {
                            $prodAttribute["bar_code"] = __is_null_undefined($prod['bar_code']);
                            $prodAttribute["name"] = __is_null_undefined($prod['name']);
                            $prodAttribute["model_no"] = __is_null_undefined($prod['model_no']);
                            $prodAttribute["brand_name"] = __is_null_undefined($prod['brand_name']);
                            $prodAttribute["details"] = __is_null_undefined($prod['details']);
                            $prodAttribute["introduction"] = __is_null_undefined($prod['introduction']);
                            $prodAttribute["features"] = __is_null_undefined($prod['features']);
                            $prodAttribute["specification"] =__is_null_undefined($prod['specification']);
                            $prodAttribute["warranty"] =__is_null_undefined($prod['warranty']);
                            $prodAttribute["master_category_id"] = json_decode($prod['master_category_id']);
                            $prodAttribute["main_category_id"] = json_decode($prod['main_category_id']);
                            $prodAttribute["sub_category_id"] = json_decode($prod['sub_category_id']);
                            $prodAttribute["origin"] = __is_null_undefined($prod['origin']);
                            $prodAttribute["unit_of_measure_id"] = json_decode($prod['unit_of_measure_id']);
                            $prodAttribute["is_private"] = json_decode($prod['is_private']);
                            $prodAttribute['created_at'] = __utc_time_now();
                            
                            $product = $this->productRepository->create($prodAttribute);

                            if ($product) {
                                $businessProdAttr['product_id'] = $product->id;
                                $businessProdAttr['business_id'] = $business['model']->id;
                                $businessProdAttr['created_at'] = __utc_time_now();

                                $businessProduct = $this->businessProductRepository->create($businessProdAttr);
                            }
                        }
                    }
                }

                \DB::commit();

                return response(true, 200);
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
    }

    /**
     * Register new user. This method is placed under the API route and is called by our WP registration process
     *
     * @return array 
     */
    public function registerUser(Request $request)
    {
        $userAttributes['user_type_id'] = $request->input('user_type_id');
        $userAttributes['first_name'] = strtolower($request->input('first_name'));
        $userAttributes['last_name'] = strtolower(__is_null_undefined($request->input('last_name')));
        $userAttributes['phone'] = __is_null_undefined($request->input('telephone'));
        $userAttributes['email'] = $request->input('email');
        $userAttributes['password'] = bcrypt($request->input('password'));
        $userAttributes['created_at'] = __utc_time_now();
        $userAttributes['is_confirmed'] = 0;
        $userAttributes['created_from_social'] = 'regular';

        \DB::beginTransaction();
        try {
            $user = new \App\Model\User;
            $user->fill($userAttributes);
            
            if (!$user->validate()) {
                return response($user->errors, 422);
            }

            $user = $this->userRepository->create($userAttributes);

            if ($user) {
                $businessAttributes['industry_type_id'] = 1;
                $businessAttributes['business_category_id'] = 1;
                $businessAttributes['phone'] = $request->input('telephone');
                $businessAttributes['website'] = $request->input('website');
                $businessAttributes['legal_name'] = $request->input('legal_name');
                $businessAttributes['email'] = $request->input('email');
                $businessAttributes['created_at'] = __utc_time_now();
                $businessAttributes['status'] = 'public';

                $businessModel = new \App\Model\Business;
                $businessModel->fill($businessAttributes);

                if (!$businessModel->validate()) {
                    return response($businessModel->errors, 422);
                }

                $business = $this->businessService->saveBusiness($businessAttributes);

                if ($business['success']) {
                    $userBusiness = new \App\Model\User\UserBusiness;
                    $userBusiness->user_id = $user->id;
                    $userBusiness->business_id = $business['model']->id;
                    $userBusiness->created_at = __utc_time_now();

                    $userBusiness->save();
                }
            }

            \DB::commit();

            return response(true, 200);

        } catch (\Exception $e) {

        }
    }
}
