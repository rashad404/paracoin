<?php

namespace App\Helpers;

use App\Models\Coin;
use App\Models\CoinAddress;
use App\Models\CoinTransaction;

class CoinPrice
{
    /*
     based on the maxMarketCap = 10,000,000,000,000 = 10 trillion USD
     maxSupply = 1,000,000,000 coin
     max price = maxMarketCap / maxSupply = 10,000 USD
    */
    private static $maxPrice = 10000;

    private static $maxTotalAddress = 10000000000;
    private static $maxActiveAddress = 10000000000 / 2;

    // USD Daily trade volume: 5,100,000,000,000 // Businessinsider HSBC report
    private static $volume_1 = 5100000000000;
    private static $volume_30 = 5100000000000 * 30;

    public static function get(){
        $usage = [];
        $usage['total_address'] = self::totalAddressUsage(self::$maxTotalAddress);
        $usage['active_address'] = self::activeAddressUsage(self::$maxActiveAddress);
        $usage['volume_1'] = self::volumeUsage1(self::$volume_1);
        $usage['volume_30'] = self::volumeUsage30(self::$volume_30);
        $usage['circulatingSupply'] = self::circulatingSupplyUsage();

        $average_usage = array_sum($usage)/count($usage);
        $price = (self::$maxPrice * $average_usage) / 100;
        $price = number_format($price, 10, '.', '');

        return $price;
    }

    public static function calculateUsage($total, $max){
        $usage = number_format($total * 100 / $max, 10);
        return $usage;
    }
    
    public static function totalAddressUsage($max){
        $total = CoinAddress::where('status', 1)->get()->count();
        return self::calculateUsage($total, $max);
    }

    public static function activeAddressUsage($max){
        $total = CoinAddress::where('status', 1)->where('update_time', '>', 0)->get()->count();
        return self::calculateUsage($total, $max);
    }

    public static function volumeUsage1($max){
        $total = CoinTransaction::where('time', '>', time()-86400)->sum('amount');
        return self::calculateUsage($total, $max);
    }

    public static function volumeUsage30($max){
        $total = CoinTransaction::where('time', '>', time()-86400*30)->sum('amount');
        return self::calculateUsage($total, $max);
    }

    public static function circulatingSupplyUsage(){
        $query = Coin::where('id',1)->select('circulatingSupply','maxSupply')->first();
        return self::calculateUsage($query->circulatingSupply, $query->maxSupply);
    }


}