<?php

use App\Models\Company;
use App\Models\License;
use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

function registered_company($auth_id)
{
    $result = true;
    $reg = Company::where('user_id', $auth_id)->first();
    if(is_null($reg))
    {
        return false;
    }

    return $result;
}

function diff_in_time($date1, $date2)
{
    if($date1->diffInDays($date2) == 0){
        if($date1->diffInHours($date2)==0){
            if($date1->diffInMinutes($date2)==0){
                return $date1->diffInSeconds($date2)." secs";
            }else{
                return $date1->diffInMinutes($date2)." mins";
            }
        }else{
            return $date1->diffInHours($date2)." hrs";
        }
    }else{
        return $date1->diffInDays($date2)." days";
    }

}

function diff_minutes($date1){
    //$finaldate = Carbon::createFromFormat('d/m/Y h:i:s', $date1);
    //$timestamp = $finaldate->getTimestamp();
    //return $timestamp->diffInDays(Carbon::now());
    return 30;
}

function license_status($value){
    if($value == 0){
        return "Not Licensed";
    }else{
        return "License Valid";
    }
}

function reg_status($value){
    if($value == 0){
        return "Not Registered";
    }else{
        return "Active Registration";
    }
}

function add_license_days(){
    return Carbon::now()->addMonth();
}

function check_license($company_id){
    $license = License::where('company_id', $company_id)->first();
    if(is_null($license)){
        return 0;
    }else{
        if($license->status == 0){
            return -1;
        }else{
            return 1;
        }
    }
}

function company($auth_id){
    $company = Company::where('user_id', $auth_id)->first();
    if(is_null($company))
    {
        return null;
    }

    return $company;
}

function check_registration($company_id){
    $reg = Registration::where('company_id', $company_id)->first();
    if(is_null($reg)){
        return 0;
    }else{
        if($reg->status == 0){
            return -1;
        }else{
            return 1;
        }
    }
}
