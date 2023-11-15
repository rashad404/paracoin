<?php

namespace App\Helpers;

class Format
{
    public static function urlText($text)
    {
        $text = preg_replace('/%/', '', $text);
        $text = preg_replace('/\//', '', $text);
        $text = mb_strtolower($text);
        $text = urlencode($text);
        return $text;
    }
    public static function listTitle($text, $length = 100)
    {
        $text = ucfirst(mb_strtolower($text));
        if (strlen($text) > $length) {
            $text = substr($text, 0, $length) . '...';
        }
        return $text;
    }

    public static function listText($text, $length = 25)
    {
        return mb_substr(strip_tags(html_entity_decode($text)), 0, $length);
    }
}
