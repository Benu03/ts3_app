<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Helpers\Bridge;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $usersession = session()->get('user');
        $body = [
            'session_token' => $usersession['session_token'],
            'username'      => $usersession['username']
        ];

        $timestamp = arbon::now()->format('Y-m-d H:i:s');
        $encryptionKey = config('static.key_access') . $timestamp;
        $keyPun = hash(config('static.key_hash'), $encryptionKey);

        $responseSession = Http::withHeaders([
            'Content-Type' => 'application/json',
            'key-service' => $keyPun,
            'timestamp' => $timestamp
        ])->post(config('static.url_access_session'), $body);


        $responseSessionData = json_decode($responseSession ,true);


       if($responseSessionData['status'] == 200)
        {

        
        $data = [
            'page_title'    => 'TS3 APP',
            'page_url'      => 'null',
            'secretKey' =>  config('static.key_static'),
            'module'   => session()->get('module'),
            'user'  => session()->get('user'),
        ];

        return view('main.lobby',compact('data'));
        }
        else{
            return redirect()->route('home');
        }
    }

  

    public function lobby(){
       
     
        $data = [
            'page_title' => 'TS3 Indonesia',
            'page_url' => 'null',
            'secretKey' =>  config('static.key_static'),
            'module'   => session()->get('module'),
            'user'  => session()->get('user'),
        ];
        

        return view('main.lobby',compact('data'));
    }


    public function reset()
    {
        if(session()->get('user')){
            return redirect()->route('main');
        }

        return view('auth.reset');
    }

    public function otp()
    {
        if(session()->get('user')){
            return redirect()->route('main');
        }

        $data = [
            'message'   => session()->get('message'),
            'username'  => session()->get('username'),
            'otp'       => session()->get('otp'),
            'via'       => session()->get('via')
        ];

        return view('auth.otp', compact('data'));
    }

    public function reset_password()
    {
        if(session()->get('user')){
            return redirect()->route('main');
        }

        $data = [
            'username'  => session()->get('username'),
        ];

        return view('auth.reset_password', compact('data'));
    }

    public function view_main()
    {
        $data = [
            'page_title' => 'TS3 App',
            'page_url' => 'null'
        ];

        return [
            'data' => compact('data'),
            'view' => view('main.lobby',compact('data'))->render()
        ];
    }

    public function success(){
        return view('auth.success_reset');
    }
    

    public function profile()
    {
        $data = [
            'page_title'    => 'TS3 APP',
            'page_url'      => 'null',
            'secretKey' =>  config('static.key_static')
        ];

        return view('main.profile',compact('data'));
    }

    public function logout(Request $request) {
        $params = [
            'url' => config('static.url_access').'/auth/logout',
            'body' => [
                'username'      => session()->get('user')['username'],
                'session_token' => session()->get('user')['session_token'],
            ]
        ];

        $response = Bridge::BuildCurlApiPA($params);
        if($response['status'] == 200){
            session()->flush();
            return redirect()->route('login')->with(['warning' => 'Logout Berhasil']);
        }

    }

    
    
}

