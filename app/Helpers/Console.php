<?php

namespace App\Helpers;

class Console
{

    public static function log($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
        exit;
    }

}
