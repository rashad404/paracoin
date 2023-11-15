<?php

namespace App\Helpers;

class HashMaker
{
    public static function string($length=32){
        $str = md5(rand(1, 10) . microtime());
        $str = substr($str, 0, $length);

        return $str;
    }
}