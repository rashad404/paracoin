<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    use HasFactory;

    protected $fillable = [
        'marketCap',
        'price',
        'initialPrice',
    ];
    public $timestamps = false;

    public static function price() {
        $price = Coin::where('id', 1)->value('currentPrice');
        return $price;
    }

    public static function convert($amount, $type = 'usdtopara') {
        if ($type == 'paratousd') {
            return $amount * self::price();
        } else {
            return number_format($amount / self::price(), 10, '.', '');
        }
    }
}
