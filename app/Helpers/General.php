<?php

namespace App\Helpers;

use DateTime;
use Carbon\Carbon;
use App\UsCity;
use App\UsCounty;
use App\UsState;

class General
{
    public static function getGenderName($gender){
        if($gender==1){
            return 'Female';
        }else{
            return 'Male';
        }
    }

    public static function getAge($birth_date){
        $age = Carbon::parse($birth_date)->age;
        if($age<16 or $age>90)$age='';
        return $age;
    }

    public static function randomStr($length = 10, $type = 'a-zA-Z0-9', $exclude = '') {
        $chars = $randomStr = '';
        if (preg_match('/a-z/', $type)) $chars .= 'abcdefghijklmnopqrstuvwxyz';
        if (preg_match('/A-Z/', $type)) $chars .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        if (preg_match('/0-9/', $type)) $chars .= '0123456789';
        if (empty($chars)) $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        if (strlen($exclude) > 0) $chars = preg_replace("/[$exclude]/", "", $chars);

        $charLength = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $randomStr .= $chars[rand(0, $charLength - 1)];
        }
        return $randomStr;
    }
}