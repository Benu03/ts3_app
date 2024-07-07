<?php

namespace App\Http\Helpers;
use Illuminate\Support\Facades\Validator as Validate;

class Validator
{
    public static function access_login($request)
    {
        $messages = [
            'username.required' => 'Please input username',
            'password.required' => 'Please input password'
        ];
        $validated = Validate::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ],$messages);

        return $validated;
    }

    public static function email_reset($request)
    {
        $messages = [
            'email.required'=> 'Please input email',
            'email.email'   => 'Please enter a valid email address',
            'otp_code.required' => 'Please select otp code'
        ];
        $validated = Validate::make($request->all(), [
            'email' => 'required|email',
            'otp_code' => 'required'
        ],$messages);

        return $validated;
    }

    public static function password_reset($request)
    {
        $messages = [
            'password.required' => 'Please input new password'
        ];
        $validated = Validate::make($request->all(), [
            'email' => 'required|min:6'
        ],$messages);

        return $validated;
    }

    public static function import_excel($request)
    {
        $messages = [];
        $validated = Validate::make($request->all(), [
			'file' => 'required|mimes:xls,xlsx'
        ],$messages);

        return $validated;
    }
}
