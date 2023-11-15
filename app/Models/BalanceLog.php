<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'usdAmount',
        'coinAmount',
        'oldCoinBalance',
        'newCoinBalance',
        'method',
        'note',
    ];
}
