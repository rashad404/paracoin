<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    private static $instance;
    public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function __construct()
    {
        parent::__construct();
//        $this->array['meta']['title'] = self::$prefix.$this->array['meta']['title'];
        $this->setTitle($this->array['meta']['title']);
    }

    public function setTitle($text)
    {
        if (strlen($text) > self::$title_char_limit) {
            $text = substr($text, 0, self::$title_char_limit);
        }
        $this->array['meta']['title'] = self::$prefix . $text;
    }
    public function addTitle($text)
    {
        if (strlen($text) > self::$title_char_limit) {
            $text = substr($text, 0, self::$title_char_limit);
        }
        $this->array['meta']['title'] = $text.' | '.$this->array['meta']['title'];
    }

    public function setKeywords($text){
        if(strlen($text)>self::$keyword_char_limit){
            $text = substr($text,0, self::$keyword_char_limit);
        }
        $this->array['meta']['keywords'] = self::$prefix.$text;
    }

    public function setDescription($text){
        if(strlen($text)>self::$desc_char_limit){
            $text = substr($text,0, self::$desc_char_limit);
        }
        $this->array['meta']['description'] = self::$prefix.$text;
    }

    public function createKeywordFromText(){
        $title = $this->array['meta']['title'];
        $title = preg_replace('/^'.self::$prefix.'$/','',$title);
        $title = preg_replace('/\|/','',$title);
        $title = preg_replace('/\s+/', ' ', $title);
        $title = trim($title);
        $title = preg_replace('/ /',', ',$title);
        $this->array['meta']['keywords'] = $title;
    }

    private static $title_char_limit = 60;
    private static $desc_char_limit = 150;
    private static $keyword_char_limit = 250;

    public static $prefix = '';
    public $array = [
        'meta' => [
            'title' => 'Paracoin.network - Digital wallet, Exchange, NFT',
            'keywords' => 'Paracoin.network - send money, e-wallet, online payment, payment gateway',
            'description' => 'Paracoin.network - Digital wallet, Exchange, NFT',
            'img' => 'images/logo/paracoin-logo.png'
        ]
    ];


    public function general()
    {
        return $this->array;
    }
    public function index()
    {
        return $this->array;
    }





}
