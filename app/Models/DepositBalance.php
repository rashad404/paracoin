<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DepositBalance extends Model
{
    use HasFactory;

    protected $fillable = [
        'addressID',
        'usd',
        'azn',
        'btc',
        'eth',
    ];

    public static function updateAmount($addressID, $amount) {
        $query = self::firstOrNew(['addressID' => $addressID]);
        $query->usd = ($query->usd + $amount);
        $query->save();
    }
}
