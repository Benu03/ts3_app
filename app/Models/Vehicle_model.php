<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vehicle_model extends Model
{


    public function GetTempVehicle($username)
    {
    	$query = DB::connection('ts3')->table('tmp.tmp_vehicle')
                ->where('user_upload', $username)->get();
        return $query;
    }



}
