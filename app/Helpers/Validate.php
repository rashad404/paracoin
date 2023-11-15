<?php

namespace App\Helpers;

use App\Models\CoinAddress;

class Validate
{
    public static function transfer($to, $amount)
    {
        $get_address = CoinAddress::getAddress();
        $address = $get_address['address'];
        $balance = $get_address['balance'];

        $error = [];
        if ($address == $to) {
            $error[] = "You can't send coin to yourself";
        } elseif ($amount > $balance) {
            $error[] = "
                You don't have enough balance<br/>
                <a href='/buy' target='_blank' style='text-decoration:underline;'>Buy " . config('coin.name') . "</a>
            ";
        } else {
            $to_check = CoinAddress::where('address', $to)->first();
            if (!$to_check) {
                $error[] = "Receiver address is not found.";
            }
        }

        return ['error' => $error];
    }
}
