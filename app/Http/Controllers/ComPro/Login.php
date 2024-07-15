<?php

namespace App\Http\Controllers\ComPro;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User_model;
use App\Helpers\Website;
use App\Http\Controllers\Feature\EmailContoller;
use App\Jobs\SendEmailAutomatic;
use Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\Bridge;
use Illuminate\Support\Facades\Session;
use App\Http\Helpers\Validator as ValidCheck;

class Login extends Controller
{
    // Main page
    public function index()
    {
    
    	$site = DB::connection('ts3')->table('cp.konfigurasi')->first();
        $data = array(  'title'     => 'Login',
    					'site'		=> $site);
        return view('login/index',$data);
    }

    // Cek
    public function check(Request $request)
    {
  
        $validated = ValidCheck::access_login($request);
        if($validated->fails()){
            return redirect('login')->withErrors($validated)->withInput();
        }
        else {
            $params = [
                'url' => config('static.url_access').'/auth/login',
                'body' => [
                    'username'  => $request->username,
                    'password'  => $request->password,
                ]
            ];

            $response = Bridge::BuildCurlApiPA($params);

         
            
            if($response['status'] == 200){
                $params = [
                    'session_token' => $response['data']['session']['session_token'],
                    'username'      => $response['data']['user_data']['username'],
                    'full_name'     => $response['data']['user_data']['full_name'],
                    'email'         => $response['data']['user_data']['email'],
                    'nik'           => $response['data']['user_data']['nik'],
                    'phone'     => $response['data']['user_data']['phone'],
                    'wa_number'     => $response['data']['user_data']['wa_number'],
                    'type'     => $response['data']['user_data']['type'],
                    'entity'     => $response['data']['user_data']['entity'],
                    'division'     => $response['data']['user_data']['division'],
                    'department'     => $response['data']['user_data']['department'],
                    'position'     => $response['data']['user_data']['position'],
                    'address'     => $response['data']['user_data']['address'],
                    'image_url'     => $response['data']['user_data']['image_url']
                ];

                Session::put('user', $params);
                Session::put('module', $response['data']['module']);
                                
                return redirect()->route('lobby')->with(['warning' => 'Login Berhasil']);

            }else if($response['status'] == 401){
                return redirect()->route('login')->with(['warning'=>$response['message']]);
               
            }else{
               
                return redirect()->route('login')->with(['warning' => 'Mohon maaf, User Anda Tidak Terdaftar']);
               
            }

        }

        
    }


    public function logout()
    {
        DB::connection('ts3')->table('auth.users')->where('username',Session()->get('username'))->update([
            'is_login'     => false
            ]);  
        Session()->forget('module');
        Session()->forget('user');
        return redirect('login')->with(['sukses' => 'Anda berhasil logout']);
    }

    // Forgot password
    public function fogot()
    {
    	$site = DB::connection('ts3')->table('cp.konfigurasi')->first();
       	$data = array(  'title'     => 'Lupa Password',
    					'site'		=> $site);
        return view('login/lupa',$data);
    }


    public function forgot_process(Request $request)
    {
        // Validasi request
        $validated = Validator::make($request->all(), [
            'email' => 'required|email'
        ], [
            'email.required' => 'Please input email',
            'email.email' => 'Please enter a valid email address'
        ]);
    
        if ($validated->fails()) {
            // Jika validasi gagal, kembali ke halaman reset dengan pesan peringatan
            return redirect()->route('reset_page')->with('warning', $validated->errors()->first());
        } else {
             $via = 'EMAIL'; // Default reset method is email
    
            $params = [
                'url' => config('static.url_access') . '/auth/forgot',
                'body' => [
                    'email' => $request->email,
                    'reset_by' => $via,
                ]
            ];

           
    
            $response = Bridge::BuildCurlApiPA($params);
    
            Log::info($response);
            if ($response['status'] == 200) {
 
                $data = [
                    'username' => $request->email,
                    'otp' => $response['data']['otp'], // Mengasumsikan API mengembalikan data OTP
                    'message' => $response['message'], // Mengasumsikan API mengembalikan pesan
                    'via' => $via, // Set metode reset (Email atau WhatsApp)
                ];
    
  
                Log::info($data);
    

                return redirect()->route('otp_page')->with($data);
            } else if ($response['status'] == 401) {
                    return redirect()->route('reset_page')->with('warning', 'Tidak ditemukan akun dengan alamat email tersebut.');
            } else {

                return redirect()->route('reset_page')->with('warning', 'Terjadi kesalahan saat memproses permintaan reset.');
            }
        }
    }
    
    

    

    public function verify_process(Request $request)
    {

        
        if($request->password1 <> $request->password2){

            return redirect('login/verify/'.$request->token)->with(['warning' => 'Password Tidak sama']);
        }
        else
        {
            DB::connection('ts3')->table('auth.users')->where('email',$request->email)->update([
                'password'      => sha1($request->password1),
                'updated_at'    => date("Y-m-d h:i:sa"),
                'update_by'     => $request->email
            ]);
        return redirect('login')->with(['sukses' => 'Password berhasil Di Update']);  
        }
        

             

    }

    public function verify($token)
    {
        $checkToken = DB::connection('ts3')->table('auth.user_token')->where('token',$token)->first();
    	$site = DB::connection('ts3')->table('cp.konfigurasi')->first();
       	$data = array(  'title'     => 'Verify Password',
    					'site'		=> $site,
                         'token'   => $token,
                        'email' => $checkToken->email,  );
        
       
       if(isset($checkToken))
       {
            $interval = strtotime(date("Y-m-d h:i:sa"))-strtotime($checkToken->created_date);
           //15 menit
            if($interval <= 900)
            {
                return view('login/verify',$data)->with(['sukses' => 'Silakan Masukan Password Baru Anda.!!']);;

            }
            else{

                return redirect('login')->with(['warning' => 'Mohon maaf, Token anda Expired']);
            }

       }
       else
       {
        return redirect('login')->with(['warning' => 'Mohon maaf, Token anda Tidak ada']);
       }
        

       
    }



    public function konfimasi($username)
    {

        $site = DB::connection('ts3')->table('cp.konfigurasi')->first();

        $data = array(  'title'     => 'Login Konfirmasi',
                        'site'		=> $site,
                        'username'  => $username);
            return view('login/login-konfirmasi',$data)->with(['sukses' => 'Mohon Untuk Melengkapi Data Akun']);;

      

    }




    public function konfimasi_proses(Request $request)
    {
        
       
        if($request->password1 <> $request->password2){

            return redirect('login/login-konfirmasi/'.$request->username)->with(['warning' => 'Password Anda Tidak sama']);
        }
        else
        {
            DB::connection('ts3')->table('auth.users')->where('username',$request->username)->update([
                'email'      => $request->email,
                'phone'      => $request->phone,
                'wa_number'      => $request->wa_number,
                'is_confirm'      => true,
                'password'      => sha1($request->password1),
                'updated_at'    => date("Y-m-d h:i:sa"),
                'update_by'     => $request->email
            ]);
        return redirect('login')->with(['sukses' => 'Data berhasil Di Update,Silakan Login Kembali']);  
        }


    }

    public function reset_password(Request $request) {


        $validated = ValidCheck::password_reset($request);
        if(!isset($request->email)){
            return redirect()->route('reset_page')->with(['warning' => 'Sesi Anda Berakhir silakan mencoba kembali']);
        }

        if($validated->fails()){
            return redirect()->route('reset_page')->with(['warning' => $validated]);
        }else {
            $params = [
                'url' => config('static.url_access').'/auth/reset-password',
                'body' => [
                    'username'      => $request->email,
                    'new_password'  => $request->password,
                ]
            ];
            $response = Bridge::BuildCurlApiPA($params);

            if($response['status'] == 200){
                return redirect()->route('success_reset')->with(['warning' => $response['message']]);
            }else if($response['status'] == 401){
                return redirect()->route('reset_page')->with(['warning'=>$response['message']]);
            }
        }
    }



    


    
}
