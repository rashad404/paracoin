<?php // Code within app\Helpers\Date.php

namespace App\Helpers;

use DateTime;

class Date
{
    public static function timeElapsedString($datetime, $full = false) {

        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;


        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'min',
//            's' => 'sec',
        );
        foreach ($string as $key => $value) {
            if ($diff->$key) {
                $array[] = $diff->$key . ' ' . $value . ($diff->$key > 1 ? 's' : '');
            }
        }
        if(!empty($array)) {
            $array = array_slice($array, 0, 1);
            $text = implode(', ', $array) . ' ago';
        }else{
            $text = 'Just now';
        }
        return $text;
    }

    public static function getOnline($time){
        $date_time = date("Y-m-d H:i:s", $time);
        if($time>time()- config('global.online_time')){
            $online_text = 'Just now';
        }else{
            $online_text = self::timeElapsedString($date_time);
        }
        return $online_text;
    }
    public static function getTime($time){
        $date_time = '';
        if(date("d")==date("d",$time)){
            $date_time = date("H:i", $time);
        }elseif(date("Y")==date("Y",$time)){
            $date_time = date("m/d H:i", $time);
        }elseif(date("Y")==date("Y",$time)){
            $date_time = date("m/d/Y", $time);
        }
        return $date_time;
    }
}