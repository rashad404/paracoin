<?php

namespace App\Helpers;

class ViewCache
{
    public static function create($view){
        $cache_file = '../cache_files/'.md5($_SERVER['REQUEST_URI']).'.html';

        $cached = fopen($cache_file, 'w');
        fwrite($cached, $view);
        fclose($cached);
        echo $view;
    }

    public static function delete(){
        $cache_file = '../cache_files/'.md5($_SERVER['REQUEST_URI']).'.html';
        if(file_exists($cache_file)){
            unlink($cache_file);
        }
    }
}