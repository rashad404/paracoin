<?php

namespace App\Helpers;


class Tags
{
    public static function getGenderName($gender){
        if($gender==1){
            return 'Female';
        }else{
            return 'Male';
        }
    }

    public static function toArray($text){
        $array = explode(',', $text);
        return $array;
    }
}