<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    use HasFactory;

    protected $fillable = ['name','text'];
    public $timestamps = false;

    public static function getList(){
        return self::where('status',1)->orderBy('position','ASC')->orderBy('id','ASC')->get();
    }

    public static function getText($id, $text = ''){
        $array = self::where('id', $id)->first();
        return htmlspecialchars_decode($array->text);
    }
}
