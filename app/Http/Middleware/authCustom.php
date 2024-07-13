<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class authCustom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $usersession = session()->get('user');
        if (!$usersession) {
            return $this->handleSessionExpired($request);
        }
        
        $body = [
            'session_token' => $usersession['session_token'],
            'username'      => $usersession['username']
        ];
    
        $timestamp = Carbon::now()->format('Y-m-d H:i:s');
        $encryptionKey = config('static.key_access') . $timestamp;
        $keyPun = hash(config('static.key_hash'), $encryptionKey);

        try {
            $responseSession = Http::withHeaders([
                'Content-Type' => 'application/json',
                'key-service' => $keyPun,
                'timestamp' => $timestamp
            ])->post(config('static.url_access_session'), $body);
    

            $responseSessionData = json_decode($responseSession->getBody()->getContents(), true);

           
        } catch (\Exception $e) {
            Log::error("Error validating session: " . $e->getMessage());
            return redirect()->route('login')->withErrors(['msg' => 'Session validation failed. Please login again.']);
        }

        if (isset($responseSessionData['status']) && $responseSessionData['status'] == 200) {
            if (!session()->get('user')) {
                return $this->handleSessionExpired($request);
            }
        } else {
            session()->flush();
            return redirect(config('static.url_portal_ts3_main') . 'login');
            return redirect()->route('login')->with(['warning' => 'Please login first']);
        }
    
        return $next($request);
    }
    
    private function handleSessionExpired(Request $request)
    {
        if ($request->ajax()) {
            Log::info("Ajax Session Expired");
            $request->session()->flash('message', 'The client\'s session has expired and must log in again.');
            return response()->json([
                'error' => 'session expired',
                'message' => 'The client\'s session has expired and must log in again.'
            ], 401);
        } else {
            return redirect()->route('login')->with(['warning' => 'Please login first']);

        }
    }
}
