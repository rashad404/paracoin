<?php

namespace Database\Seeders;

use App\Helpers\General;
use App\Models\Coin;
use App\Models\CoinAddress;
use Illuminate\Database\Seeder;

class CoinAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create main addresses.
        $mainAddresses = CoinAddress::mainAddresses();
        $reservedSupply = array_sum(array_column($mainAddresses,'initialBalance'));

        foreach($mainAddresses as $mainAddress) {
            $address = CoinAddress::create([
                'address' => CoinAddress::createAddress(),
                'password' => General::randomStr(20, 'a-z0-9', 'o0l'),
                'name' => 'SYSTEM-'.$mainAddress['name'],
                'balance' => $mainAddress['initialBalance'],
                'status' => 0,
                'time' => time()
            ]);
        }
        $coinQuery = Coin::where('id',1);
        $coinQuery->decrement('availableSupply', $reservedSupply);
        $coinQuery->increment('reservedSupply', $reservedSupply);
    }
}
