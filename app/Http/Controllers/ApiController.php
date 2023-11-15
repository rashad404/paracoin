<?php

namespace App\Http\Controllers;

use App\Helpers\ViewCache;
use App\Models\Seo;
use App\Models\Coin;
use App\Models\CoinAddress;
use App\Models\CoinTransaction;

class ApiController extends Controller
{
    public function index()
    {
        $data = Seo::getInstance()->index();
        $info = Coin::where('id', 1)->first();

        $market_cap = $info->circulatingSupply * $info->currentPrice;

        $volume_24 = CoinTransaction::where('time', '>', time() - 86400)->sum('amount');
        $volume_24_currency = $volume_24 * $info->currentPrice;

        $total_addresses = CoinAddress::where('status', 1)->get()->count();
        $total_active_addresses = CoinAddress::where('status', 1)->where('update_time', '>', 0)->get()->count();

        $get_address = CoinAddress::getAddress();
        if ($get_address) {
            $data['address'] = $get_address['address'];
            $data['balance'] = $get_address['balance'];
        } else {
            $data['address'] = '';
        }

        $data += [
            'pageTitle' => 'Developer API',
            'info' => $info,
            'market_cap' => $market_cap,
            'volume_24' => $volume_24,
            'volume_24_currency' => $volume_24_currency,
            'total_addresses' => $total_addresses,
            'total_active_addresses' => $total_active_addresses,
        ];
        ViewCache::create(
            view('api.' . __FUNCTION__)->with($data)
        );
    }
}
