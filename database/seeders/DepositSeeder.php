<?php

namespace Database\Seeders;

use App\Models\Coin;
use App\Models\Deposit;
use Illuminate\Database\Seeder;

class DepositSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Deposit::create([
            'currentBalance' => 0,
            'totalDeposited' => 0,
            'totalWithdrawn' => 0,
        ]);

    }
}
