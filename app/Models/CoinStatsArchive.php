<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoinStatsArchive extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'period',
        'price',
        'marketCap',
        'circulatingSupply',
        'dailyVolume',
        'monthlyVolume',
        'totalAddresses',
        'activeAddresses',
    ];

    public static function calculateAndCreate() {

        $info = Coin::where('id',1)->first();

        $market_cap = $info->circulatingSupply * $info->currentPrice;

        $dailyVolume = CoinTransaction::where('time', '>', time()-86400)->sum('amount');
        $monthlyVolume = CoinTransaction::where('time', '>', time()-86400*30)->sum('amount');

        $total_addresses = CoinAddress::where('status', 1)->get()->count();
        $total_active_addresses = CoinAddress::where('status', 1)->where('update_time', '>', 0)->get()->count();
        


        CoinStatsArchive::insert([
            'period' => date('Y-m-d H:i'),
            'price' => $info->currentPrice,
            'marketCap' => $market_cap,
            'circulatingSupply' => $info->circulatingSupply,
            'dailyVolume' => $dailyVolume,
            'monthlyVolume' => $monthlyVolume,
            'totalAddresses' => $total_addresses,
            'activeAddresses' => $total_active_addresses,
        ]);
    }
}
