<?php

namespace App\Http\Controllers;

use App\Model\UserSearchHistories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Plans;
use App\Model\Countries;
use App\Exports\BusinessListExport;
use App\Model\User;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging;
use Kreait\Firebase\Factory;
use Notification;
use App\Notifications\SendPushNotification;


class HomeController extends Controller
{
    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function excel()
    {
        // $plans = Plans::pluck('name')->toArray();
        // return (new BusinessListExport($plans))->download('template.xlsx');
        return response()->download(storage_path("app/public/uploads/template.xlsx"));
    }


    public function categoryTemplate()
    {
        // return response()->download(storage_path("app/public/uploads/Durio-Category.xlsx"));
        return response()->download(storage_path("app/public/uploads/BusinessCategory.xlsx"));
    }

    public function index()
    {
        $path = storage_path('app/public/uploads/businessbanners');
        $storage_path_exists = \File::isDirectory($path);

        if (!$storage_path_exists) { // check if storage path exsist if not call storage:link
            \Artisan::call('storage:link');
        }


        // Get search tags for search component
        $searchTags = null;
        if (Auth::check()) {
            // $searchTagsCount = \DB::table('usersearchhistories')->where('userID', Auth::user()->id)->count();

            // if ($searchTagsCount > 0) {
            //     $searchTags = \DB::table('usersearchhistories')->where('userID', Auth::user()->id)
            //         ->select('keyword')
            //         ->distinct()
            //         // ->orderBy('id', 'desc')
            //         ->paginate(10);
            // }
        }

        return view('home', compact('searchTags'));
    }

    public function getCountries()
    {
        $countries = Countries::all();

        return response()->json(['countries' => $countries]);
    }

    public function saveToken(Request $request)
    {
        // try{
        //     $request->user()->update(['device_token'=>$request->token]);
        //     return response()->json([
        //         'success'=>true
        //     ]);
        // }catch(\Exception $e){
        //     report($e);
        //     return response()->json([
        //         'success'=>false
        //     ],500);
        // }
        $firebaseToke = \App\Model\FirebaseDeviceToken::where('device_token', $request->token)->where('user_id', auth()->user()->id)->first();

        if(!$firebaseToke) {

            $firebase = new \App\Model\FirebaseDeviceToken();


            $firebase->user_id = auth()->user()->id;
            $firebase->device_token = $request->token;
            if($firebase->save()) {
                return response()->json(['token saved successfully.']);
            }
            else {
                return response()->json(['not save token'], 200);
            }
        }

        return response()->json(['token saved already'], 200);
    }

    public function sendNotification(Request $request)
    {

        $user = User::find($request->user);

        $device_token = \App\Model\FirebaseDeviceToken::whereNotNull('device_token')->pluck('device_token')->all();

        // return response()->json([$device_token, $user->id], 200);
        // if(!$device_token) {
            // $device_token = User::whereNotNull('device_token')->pluck('device_token')->toArray();


            $SERVER_API_KEY = 'AAAA3TFMRT0:APA91bH242n91vAOFcAVtlHM6R3SfOsQw3_aomSE8a60ihuDbARJwar90BXPvI5gswIfZtzRNhNLPS59xaT4rQcX3dlDl0OJ6bKI6FRHq8NPgoMZXxAzcOZ1bYMdlWkWxw1yv0k7j9gw';

            $data = [
                "registration_ids" => $device_token,
                "notification" => [
                    "title" => $request->title,
                    "body" => auth()->user()->first_name. " " . auth()->user()->last_name." ".$request->message,
                    "content_available" => true,
                    "priority" => "high",
                ]
            ];
            $dataString = json_encode($data);

            $headers = [
                'Authorization: key=' . $SERVER_API_KEY,
                'Content-Type: application/json',
            ];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

            $response = curl_exec($ch);

            return response()->json($response, 200);
        // }
    }
}
