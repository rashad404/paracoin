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
use App\Models\PartnerStore;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoinController extends Controller
{
    public function index()
    {
        $data = Seo::getInstance()->index();
        $info = Coin::where('id', 1)->first();

        $market_cap = $info->circulatingSupply * $info->currentPrice;

        $volume_24_hour = CoinTransaction::where('time', '>', time() - 86400)->sum('amount');
        $volume_24_hour_currency = $volume_24_hour * $info->currentPrice;

        $volume_30_day = CoinTransaction::where('time', '>', time() - 86400 * 30)->sum('amount');
        $volume_30_day_currency = $volume_30_day * $info->currentPrice;

        $total_addresses = CoinAddress::where('status', 1)->get()->count();
        $total_active_addresses = CoinAddress::where('status', 1)->where('update_time', '>', 0)->get()->count();

        $coinStatsArchiveQuery = CoinStatsArchive::where('id', '>', 0)->pluck('period', 'price')->toArray();

        $coinStatsArchive = ['price' => [], 'period' => []];
        foreach ($coinStatsArchiveQuery as $key => $value) {
            $coinStatsArchive['price'][] = $key;
            $coinStatsArchive['period'][] = date('M d', strtotime($value));
        }

        $get_address = CoinAddress::getAddress();
        if ($get_address) {
            $data['address'] = $get_address['address'];
            $data['balance'] = $get_address['balance'];
        } else {
            $data['address'] = '';
        }

        $data += [
            'pageTitle' => config('coin.name'),
            'info' => $info,
            'market_cap' => $market_cap,
            'volume_24_hour' => $volume_24_hour,
            'volume_24_hour_currency' => $volume_24_hour_currency,
            'volume_30_day' => $volume_30_day,
            'volume_30_day_currency' => $volume_30_day_currency,
            'total_addresses' => $total_addresses,
            'total_active_addresses' => $total_active_addresses,
            'coinStatsArchive' => $coinStatsArchive,
            'teams' => Team::where('status', 1)->get(),
            'faqs' => Faq::where('status', 1)->get(),
            'partnerStores' => PartnerStore::where('status', 1)->get(),
        ];

        // If the user is not logged in, show cached version.
        if (!$get_address) {
            ViewCache::create(view('coin.' . __FUNCTION__)->with($data));
        } else {
            return view('coin.' . __FUNCTION__)->with($data);
        }
    }

    public function stats()
    {
        $data = Seo::getInstance()->index();
        $info = Coin::where('id',1)->first();

        $market_cap = $info->circulatingSupply * $info->currentPrice;

        $volume_24 = CoinTransaction::where('time', '>', time()-86400)->sum('amount');
        $volume_24_currency = $volume_24 * $info->currentPrice;

        $total_addresses = CoinAddress::where('status', 1)->get()->count();
        $total_active_addresses = CoinAddress::where('status', 1)->where('update_time', '>', 0)->get()->count();
        
        $get_address = CoinAddress::getAddress();

        $data += [
            'pageTitle' => 'Statistics',
            'address' => $get_address['address'],
            'balance' => $get_address['balance'],
            'info' => $info,
            'market_cap' => $market_cap,
            'volume_24' => $volume_24,
            'volume_24_currency' => $volume_24_currency,
            'total_addresses' => $total_addresses,
            'total_active_addresses' => $total_active_addresses,
        ];
        ViewCache::create(
            view('coin.'.__FUNCTION__)->with($data)
        );
    }

    public function user_transactions()
    {
        $data = Seo::getInstance()->index();

        $get_address = CoinAddress::getAddress();
        
        if($get_address['address']){
           $list = CoinTransaction::where(function($q)  use ($get_address) {
                $q->where('from', $get_address['address'])
                ->orWhere('to', $get_address['address']);
            })->orderBy('id', 'desc')->get();
        }else{
            $list = [];
        }
        
        $data += [
            'pageTitle' => 'Your Transactions',
            'list' => $list,
            'address' => $get_address['address'],
            'balance' => $get_address['balance'],
        ];
        
        ViewCache::create(
            view('coin.'.__FUNCTION__)->with($data)
        );
    }

    public function public_transactions()
    {
        $data = Seo::getInstance()->index();

        $get_address = CoinAddress::getAddress();

        $list = CoinTransaction::orderBy('id', 'desc')->get();

        $data += [
            'pageTitle' => 'All Public Transactions',
            'list' => $list,
            'address' => $get_address['address'],
            'balance' => $get_address['balance'],
        ];

        ViewCache::create(
            view('coin.'.__FUNCTION__)->with($data)
        );
    }

    public function receive(){
        $data = Seo::getInstance()->index();

        $get_address = CoinAddress::getAddress();

        $data += [
            'pageTitle' => 'Receive',
            'address' => $get_address['address'],
            'balance' => $get_address['balance'],
        ];

        return view('coin.'.__FUNCTION__)->with($data);

    }

    public function white_paper() {
        $data = Seo::getInstance()->index();
        $data += [
            'pageTitle' => 'White paper',
        ];
        return view('coin.'.__FUNCTION__)->with($data);
    }



    public function roadmap(){
        $data = Seo::getInstance()->index();
        $data += [
            'pageTitle' => 'Roadmap',
        ];
        return view('coin.roadmap')->with($data);
    }

    public function roadmapOld(){
        $data = Seo::getInstance()->index();
        $data += [
            'pageTitle' => 'Roadmap',
        ];
        return view('coin.roadmap-old')->with($data);
    }

    public function send(){
        $data = Seo::getInstance()->index();

        $get_address = CoinAddress::getAddress();

        if(!$get_address){
            $get_address['address'] = '';
            $get_address['balance'] = 0;
            // return redirect(config('coin.folder').'/')
            // ->withErrors(["error"=>"You need to login!"]);
        }

        $data += [
            'pageTitle' => 'Send',
            'address' => $get_address['address'],
            'balance' => $get_address['balance'],
        ];

        return view('coin.'.__FUNCTION__)->with($data);

    }

    public function send_submit(Request $request)
    {
        if (!CoinAddress::isAuth()) return redirect(config('coin.folder').'/')->withErrors(["error"=>"You need to login!"]);
        
        $get_address = CoinAddress::getAddress();
        $address = $get_address['address'];

        $to = $request->input('to');
        $amount = $request->input('amount');
        $note = $request->input('note');

        $validation = Validate::transfer($to, $amount);
        if ($validation['error']) return redirect(config('coin.folder').'/send')->withErrors(["error"=> $validation['error']]);

        $validated = $request->validate([
            'to' => 'bail|required|size:20',
            'amount' => 'bail|required|numeric|min:1|max:1000000',
            'note' => 'max:100',
        ]);
        DB::beginTransaction();
        try {
                CoinAddress::where('address', $address)->decrement('balance', $amount);
                CoinAddress::where('address', $to)->increment('balance', $amount);

                CoinTransaction::create([
                    'to'=> $to,
                    'from'=> $address,
                    'amount'=> $amount,
                    'note'=> $note,
                    'time'=> time()
                ]);
                DB::commit();
            }
        catch (\Exception $e)
        {
            DB::rollBack();
            return redirect(config('coin.folder').'/')
            ->withErrors(["error"=> 'DB Error! Try again']);
        }

        return redirect(config('coin.folder').'/')
        ->withErrors(["success"=> 'You have successfully sent '.$amount.' '.config('coin.symbol').' to '.$to]);
    }

    public function create_address(){
        $data = Seo::getInstance()->index();

        $address = session('address');
        if(empty($address)){
            $address = CoinAddress::createAddress();
            $password = General::randomStr(6, 'a-z0-9', 'o0l');
            $check = CoinAddress::where('address', $address)->first();
            if(!$check){
                CoinAddress::create([
                    'address'=> $address,
                    'password'=> $password,
                    'time'=> time()
                ]);
                session(['address' => $address]);
            }
    
            $data += [
                'pageTitle' => 'Create Address',
                'address' => $address,
                'password' => $password,
            ];

            return view('coin.'.__FUNCTION__)->with($data)->withErrors(["success" => __('text.You have successfully created a new adddress')]);
        }else{
            $data += [
                'pageTitle' => 'Create Address'
            ];
            return redirect(config('coin.folder').'/')
                    ->withErrors(["error"=>"You already have an adddress"]);
        }
    }

    public function login(){
        session(['address' => false]);
        $data = Seo::getInstance()->index();

        $address = session('address');
        if ($address) {
            return redirect(config('coin.folder').'/')
            ->withErrors(["error"=>"Please logout, then try again!"]);
        }

        $data += [
            'pageTitle' => 'Login'
        ];
        return view('coin.'.__FUNCTION__)->with($data);
    }

    public function loginSubmit(Request $request)
    {
        $address = $request->input('address');
        $password = $request->input('password');

        $check = CoinAddress::login($address, $password);
        if ($check) {
            session(['address' => $address]);
            return redirect(config('coin.folder').'/');
        } else {
            return redirect(config('coin.folder').'/')
            ->withErrors(["error"=> __('text.Login or password is incorrect!')]);
        }
    }


    public function checkoutSettings(){
        if (!CoinAddress::isAuth()) return redirect(config('coin.folder'))->withErrors(["error" => "You need to login!"]);
        $data = Seo::getInstance()->index();

        $getAddress = CoinAddress::getAddress();
        $checkoutSettings  = CheckoutSetting::getCheckoutSettings($getAddress['address']);

        $data += [
            'checkoutSettings' => $checkoutSettings,
            'pageTitle' => 'Checkout Settings'
        ];

        return view('coin.'.__FUNCTION__)->with($data);

    }

    public function checkoutSettingsSubmit(Request $request)
    {
        if (!CoinAddress::isAuth()) return redirect(config('coin.folder'))->withErrors(["error" => "You need to login!"]);
        $resultUrl = $request->input('resultUrl');
        $callbackUrl = $request->input('callbackUrl');
        $debugMode =  $request->has('debugMode') ? 1 : 0;

        $getAddress = CoinAddress::getAddress();

        $validated = $request->validate([
            'resultUrl' => 'bail|required|url|max:200',
            'callbackUrl' => 'bail|required|url|nullable|max:200',
        ]);

        CheckoutSetting::where('address',$getAddress['address'])->update([
            'resultUrl' => $resultUrl,
            'callbackUrl' => $callbackUrl,
            'debugMode' => $debugMode,
        ]);

        return redirect(config('coin.folder').'/checkout-settings')
        ->withErrors(["success"=>"Checkout settings has been updated successfully"]);
    }



    public function profile(){
        $data = Seo::getInstance()->index();

        $get_address = CoinAddress::getAddress();
        if(!$get_address['address']){
            return redirect(config('coin.folder').'/login')
            ->withErrors(["error"=>"Please log in, then try again!"]);
        }

        $user_info = CoinAddress::where('address', $get_address['address'])->first(['name','email','phone']);
        $data += [
            'pageTitle' => 'Your profile',
            'address' => $get_address['address'],
            'user_info' => $user_info,
        ];

        return view('coin.'.__FUNCTION__)->with($data);

    }

    public function profile_submit(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $password = $request->input('password');

        $validated = $request->validate([
            'name' => 'nullable|max:20',
            'email' => 'nullable|email|max:50',
            'phone' => 'nullable|numeric|digits_between:7,15'
        ]);

        $get_address = CoinAddress::getAddress();
        if(!$get_address){
            return redirect(config('coin.folder').'/')
            ->withErrors(["error"=>"Please log in, then try again!"]);
        }

        $check = CoinAddress::where('address',$get_address['address'])->where('password',$password)->first();
        if(!$check){
            return redirect(config('coin.folder').'/profile')
            ->withErrors(["error"=>"Password is incorrect!"]);
        }

        CoinAddress::where('address',$get_address['address'])->where('password',$password)->update([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ]);

        return redirect(config('coin.folder').'/profile')
        ->withErrors(["success"=>"Your profile has been updated successfully"]);
    }

    public function logout(){
        session(['address' => false]);
        return redirect(config('coin.folder').'/login')
                ->withErrors(["success" => __('text.You have been successfully logged out!')]);
    }
}
