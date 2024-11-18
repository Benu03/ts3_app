<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Bridge;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use DB;
use Log;



class OptionController extends Controller
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
        $data = [
            'page_title' => 'TS3 App',
            'page_url' => 'null'
        ];
        return view('option.index', compact('data'));
      
    }

    public function getNotifications()
    {
        
        $username =session()->get('user')['username'];
        $oneWeekAgo = Carbon::now()->subWeek();
        $notifications = DB::connection('sso')->table('ntf.v_ntf_notification_list')
        ->where('username',$username)
        ->where('created_date', '>=', $oneWeekAgo)
        ->orderBy('created_date', 'desc')->get();
        return response()->json($notifications);
    }

    public function updateNotifIsread(Request $request)
    {
        $notifId = $request->input('notif_id');
        $username = session()->get('user')['username'];
    
        $alreadyExists = DB::connection('sso')->table('ntf.ntf_notification_read')
            ->where('ntf_notification_id', $notifId)
            ->where('username', $username)
            ->exists();
    
        if (!$alreadyExists) {

            DB::connection('sso')->table('ntf.ntf_notification_read')->insert([
                'is_read' => true,
                'ntf_notification_id' => $notifId,
                'username' => $username,
                'created_date' => Carbon::now()
            ]);
        }
    
        return response()->json(['success' => true]);
    }
    


    
}

