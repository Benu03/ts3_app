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
use App\Http\Helpers\Validator;
use App\Http\Helpers\Bridge;
use Illuminate\Support\Facades\Session;

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
  
        $validated = Validator::access_login($request);
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

                Log::info($params);
                                
                return redirect()->route('lobby');

            }else if($response['status'] == 401){
                return redirect()->route('login')->with(['password'=>$response['message']]);
                // return redirect('login')->with(['password'=>$response['message']]);
                // return redirect('login')->with(['warning' => 'Mohon maaf, Email Anda Tidak Terdaftar']);
            }else{
                Log::info('disini');
                return redirect()->route('login')->with(['warning' => 'Mohon maaf, User Anda Tidak Terdaftar']);
                // return redirect('login')->with(['password'=>'login failed']);
                // return redirect('login')->with(['warning' => 'Mohon maaf, Email Anda Tidak Terdaftar']);
            }

        }

        
    }


    public function logout()
    {
        DB::connection('ts3')->table('auth.users')->where('username',Session()->get('username'))->update([
            'is_login'     => false
            ]);  
        Session()->forget('id_user');
        Session()->forget('nama');
        Session()->forget('username');
        Session()->forget('akses_level');
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
        $email   = $request->email;
        $model      = new User_model();
        $user       = $model->check_user_email(trim($email));
       
        if(isset($user))
        {
            $site = DB::connection('ts3')->table('cp.konfigurasi')->first();
      
            $token = hash('sha256',random_bytes(64).$site->namaweb);
      
             DB::connection('ts3')->table('auth.user_token')->insert([
                'email'	=> $email,
                'token'   => $token,
                'created_date'    => date("Y-m-d h:i:sa")
            ]);
            $url_img = 'https://ts3.co.id/assets/upload/image/2.png';
            $url_verify = 'https://ts3.co.id/login/verify/'.$token;

            $body = '<b>Dear Rekan TS3</b><br><br>Silakan Klik Link Untuk Mereset Password : <a class="btn btn-info" href="'.$url_verify.'"  >Reset Password</a><br><br>Best Regards<br>TS3 Indonesia<br><img src="'.$url_img.'"   width="70" height="70"  class="img-fluid" ><hr><b>TS3 Indonesia<br>Jl. Basudewa Raya 3A Ruko River View Kel Bulustalan <br>Kec Semarang Selatan 50245</b>';
            
             

            DB::connection('ts3')->table('auth.user_mail')->insert([
                'type_request' => 'RESET PASSWORD',
                'from' => $site->smtp_user,
                'to' => $email,
                'cc' => null,
                'bcc' => null,
                'subject' => 'Reset Password TS3',
                'body' => $body,
                'attachment' => null
            ]);


            // SendEmailAutomatic::dispatch();


        }
        else{
           return redirect('login')->with(['warning' => 'Mohon maaf, Email Anda Tidak Terdaftar']);
        }


        return redirect('login')->with(['sukses' => 'Silakan Check email Anda Untuk Reset Password..!!']);
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


    


    
}
