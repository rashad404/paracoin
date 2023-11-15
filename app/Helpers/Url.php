<?php

namespace App\Helpers;

class Url
{

    public static function getFullUrl()
    {
        $uri = parse_url(substr($_SERVER['REQUEST_URI'],1), PHP_URL_PATH);
        return $uri;
    }

    public static function genLink($str)
    {
        $allowed = "/[^a-z0-9\\040\\.\\-\\_\\\\]/i";
        $str=self::name_to_english_letter($str);
        $ret=preg_replace($allowed,"",$str);
        $ret=str_replace(' ','-',$ret);
        $ret=str_replace('.','-',$ret);
        $ret=strtolower($ret);
        return $ret;
    }

    public static function name_to_english_letter($name)
    {
        // AZ herfleri
        $ename = str_replace("ü","u",$name);
        $ename = str_replace("ö","o",$ename);
        $ename = str_replace("ğ","g",$ename);
        $ename = str_replace("ı","i",$ename);
        $ename = str_replace("ə","e",$ename);
        $ename = str_replace("ç","ch",$ename);
        $ename = str_replace("ş","sh",$ename);

        $ename = str_replace("Ü","u",$ename);
        $ename = str_replace("Ö","o",$ename);
        $ename = str_replace("Ğ","g",$ename);
        $ename = str_replace("İ","i",$ename);
        $ename = str_replace("Ə","e",$ename);
        $ename = str_replace("Ç","ch",$ename);
        $ename = str_replace("Ş","sh",$ename);

        //Diger shriftler
        $ename = str_replace("é","e",$ename);

        // Rus herfleri
        $ename = str_replace("А","a",$ename);
        $ename = str_replace("Б","b",$ename);
        $ename = str_replace("В","v",$ename);
        $ename = str_replace("Г","q",$ename);
        $ename = str_replace("Д","d",$ename);
        $ename = str_replace("Е","ye",$ename);
        $ename = str_replace("Ё","yo",$ename);
        $ename = str_replace("Ж","j",$ename);
        $ename = str_replace("З","z",$ename);
        $ename = str_replace("Р","r",$ename);
        $ename = str_replace("С","s",$ename);
        $ename = str_replace("Т","t",$ename);
        $ename = str_replace("У","u",$ename);
        $ename = str_replace("Ф","f",$ename);
        $ename = str_replace("Х","x",$ename);
        $ename = str_replace("Ц","c",$ename);
        $ename = str_replace("Ч","c",$ename);
        $ename = str_replace("И","i",$ename);
        $ename = str_replace("Й","y",$ename);
        $ename = str_replace("К","k",$ename);
        $ename = str_replace("Л","l",$ename);
        $ename = str_replace("М","m",$ename);
        $ename = str_replace("Н","n",$ename);
        $ename = str_replace("О","o",$ename);
        $ename = str_replace("П","p",$ename);
        $ename = str_replace("Ш","s",$ename);
        $ename = str_replace("Щ","s",$ename);
        $ename = str_replace("ъ","",$ename);
        $ename = str_replace("Ы","i",$ename);
        $ename = str_replace("ь","",$ename);
        $ename = str_replace("Э","e",$ename);
        $ename = str_replace("Ю","yu",$ename);
        $ename = str_replace("Я","ya",$ename);

        $ename = str_replace("а","a",$ename);
        $ename = str_replace("б","b",$ename);
        $ename = str_replace("в","v",$ename);
        $ename = str_replace("г","q",$ename);
        $ename = str_replace("д","d",$ename);
        $ename = str_replace("е","ye",$ename);
        $ename = str_replace("ё","yo",$ename);
        $ename = str_replace("ж","j",$ename);
        $ename = str_replace("з","z",$ename);
        $ename = str_replace("р","r",$ename);
        $ename = str_replace("с","s",$ename);
        $ename = str_replace("т","t",$ename);
        $ename = str_replace("у","u",$ename);
        $ename = str_replace("ф","f",$ename);
        $ename = str_replace("х","x",$ename);
        $ename = str_replace("ц","c",$ename);
        $ename = str_replace("ч","c",$ename);
        $ename = str_replace("и","i",$ename);
        $ename = str_replace("й","y",$ename);
        $ename = str_replace("к","k",$ename);
        $ename = str_replace("л","l",$ename);
        $ename = str_replace("м","m",$ename);
        $ename = str_replace("н","n",$ename);
        $ename = str_replace("о","o",$ename);
        $ename = str_replace("п","p",$ename);
        $ename = str_replace("ш","s",$ename);
        $ename = str_replace("щ","s",$ename);
        $ename = str_replace("ы","i",$ename);
        $ename = str_replace("э","e",$ename);
        $ename = str_replace("ю","yu",$ename);
        $ename = str_replace("я","ya",$ename);

        $ename = str_replace("ch","c",$ename);
        $ename = str_replace("sh","s",$ename);

        // Herfleri kichildirik
        $ename = strtolower($ename);

        return $ename;
    }

}
