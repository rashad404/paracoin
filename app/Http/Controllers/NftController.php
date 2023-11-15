<?php
namespace App\Http\Controllers;

use App\Helpers\General;
use App\Helpers\Validate;
use App\Helpers\ViewCache;
use App\Models\CheckoutSetting;
use App\Models\Seo;
use App\Models\Coin;
use App\Models\CoinAddress;
use App\Models\CoinStatsArchive;
use App\Models\CoinTransaction;
use App\Models\Faq;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NftController extends Controller
{
   
    public function index() {
        $data = Seo::getInstance()->index();
        $data += [
            'pageTitle' => 'NFT Marketplace',
        ];
        return view('nft.'.__FUNCTION__)->with($data);
    }
   
    public function view() {
        $data = Seo::getInstance()->index();
        $data += [
            'pageTitle' => 'NFT View',
        ];
        return view('nft.'.__FUNCTION__)->with($data);
    }
}
