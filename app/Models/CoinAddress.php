<?php

namespace App\Models;

use App\Helpers\CoinPrice;
use App\Helpers\General;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CoinAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'password',
        'balance',
        'name',
        'email',
        'phone',
        'status',
        'time',
    ];
    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'time' => 'datetime:Y-m-d H:i:s',
        'update_time' => 'datetime:Y-m-d H:i:s',
    ];


    public static function createAddress() {
        return General::randomStr(20, 'a-z0-9', 'o0l');
    }

    public static function getAddress() {
        $address = session('address');
        if(strlen($address) == config('coin.length')){
            $query = self::where('address', $address)->select('id', 'balance')->first();
            if ($query) {
                self::where('address', $address)->update(['update_time'=>time()]);
                return ['id'=> $query->id, 'address'=> $address, 'balance'=> $query->balance];
            } else {
                return ['address'=> '', 'balance'=> ''];
            }
            
        }else{
            return ['address' => '', 'balance'=> ''];
        }
    }

    public static function isAuth() {
        $address = session('address');
        if (strlen($address) == config('coin.length')) {
            $check = self::where('address', $address)->first();
            return ($check) ? true : false;
        } else {
            return false;
        }
    }

    public static function login($address, $password) {
        $check = self::where('address',$address)->where('password',$password)->first();
        if ($check) {
            session(['address' => $address]);
            return true;
        } else {
            return false;
        }
    }

    public static function addBalance($id, $amount, $currency = 'usd', $note, $method) {

        $coinAddressQuery = CoinAddress::where('id', $id);
        $coinAddress = $coinAddressQuery->first();
        if (!$coinAddress) return 'Error: address not found';
        
        $coinQuery = Coin::where('id', 1);
        $coin = $coinQuery->first();
        
        $depositQuery = Deposit::where('id',1);

        // We call USD as amount, and para as para Amount.
        if ($currency == 'para') {
            $coinAmount = $amount;
            $amount = Coin::convert($amount, 'paratousd');
        } else if ($currency == 'usd') {
            $coinAmount = Coin::convert($amount, 'usdtopara');
        }
        
        if ($coin->availableSupply < $coinAmount) return 'Error: there is not enough supply';

        $newBalance = $coinAddress->balance + $coinAmount;

        
        try {
            DB::beginTransaction();
                // Add balance to the address
                $coinAddressQuery->increment('balance', $coinAmount);
        
                // Decrease availableSupply and increase circulatingSupply
                $coinQuery->decrement('availableSupply', $coinAmount);
                $coinQuery->increment('circulatingSupply', $coinAmount);
        
                // Calculate new price and update it on the coins table (Only if it's greater than initial price)
                $newPrice = CoinPrice::get();
                if ($newPrice > $coin->initialPrice) $coinQuery->update(['currentPrice' => $newPrice]);
        
                // Add balance log
                BalanceLog::create([
                    'address' => $coinAddress->address,
                    'usdAmount' => $amount,
                    'coinAmount' => $coinAmount,
                    'oldCoinBalance' => $coinAddress->balance,
                    'newCoinBalance' => $newBalance,
                    'note' => $note,
                    'method' => $method
                ]);

                // Update deposit table
                $depositQuery->increment('currentBalance', $amount);
                $depositQuery->increment('totalDeposited', $amount);
                
                DepositBalance::updateAmount($coinAddress->id, $amount);

                // Add cash log
                DepositLog::create([
                    'address' => $coinAddress->address,
                    'usdAmount' => $amount,
                    'coinAmount' => $coinAmount,
                    'note' => $note,
                    'method' => $method
                ]);
                
            DB::commit();
        } catch (\PDOException $e) {
            // Woopsy
            DB::rollBack();
            return 'Error: DB transaction: '.$e->getMessage();
        }

        return (object) ['coinAmount' => $coinAmount];
    }

    public static function mainAddresses() {
        $array = [
            ['name'=>'admin', 'initialBalance' => 10000000],
            ['name'=>'marketing', 'initialBalance' => 20000000],
            ['name'=>'developers', 'initialBalance' => 10000000],
            ['name'=>'legal', 'initialBalance' => 10000000],
            ['name'=>'other', 'initialBalance' => 10000000],
        ];

        return $array;
    }
}
