<?php

namespace Database\Seeders;

use App\Models\Coin;
use Illuminate\Database\Seeder;

class CoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coin::create([
            'maxSupply' => '1000000000',
            'reservedSupply' =>  0,
            'availableSupply' => '1000000000',
            'circulatingSupply' => 0,
            'marketCap' => 0,
            'currentPrice' => '0.002',
            'initialPrice' => '0.002',
        ]);
    }
}
