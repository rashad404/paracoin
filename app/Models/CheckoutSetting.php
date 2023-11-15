<?php

namespace App\Models;

use App\Helpers\General;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'privateToken',
        'resultUrl',
        'callbackUrl',
        'debugMode',
    ];
    public $timestamps = false;

    public static function getCheckoutSettings($address) {
        $checkoutSettings = self::where('address', $address)->first();
        if (!$checkoutSettings) {
            return self::create([
                'address' => $address,
                'privateToken' => General::randomStr(),
            ]);    
        } else {
            return $checkoutSettings;
        }


    }
}
