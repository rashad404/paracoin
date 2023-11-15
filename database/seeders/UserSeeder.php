<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = 'Aj7lOmSLE2ie=1f';
        DB::table('users')->insert([
            'email' => 'adminpara@paracoin.network',
            'password' => \Illuminate\Support\Facades\Hash::make($password),
        ]);
    }
}
