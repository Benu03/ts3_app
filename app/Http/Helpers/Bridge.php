<?php

namespace App\Http\Helpers;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

class Bridge {

    #login
    public static function BuildCurlApiPA($params,$headers = null,$menu = null) {
        if(!$headers){
            date_default_timezone_set('Asia/Jakarta');
            $timestamp = date("Y-m-d H:i:s");
            $Encryp = config('static.key_access'). $timestamp;
            $KeyGenerate = hash(config('static.key_hash'), $Encryp);

            $headers = [
                'key-service'   => $KeyGenerate,
                'timestamp'     => $timestamp,
                'Content-Type'  => 'application/json',
            ];
         
        }
        $client = new Client([
            'verify' => false,
            'http_errors' => false,
        ]);
       
        $body           = json_encode($params['body']);
        $request        = new GuzzleRequest('POST', $params['url'], $headers, $body);
        $res            = $client->sendAsync($request)->wait();
        $content_json   = $res->getBody()->getContents();
        $content_arr    = json_decode($content_json,1);
  
        return $content_arr;
    }

    #get list Company
  


}
