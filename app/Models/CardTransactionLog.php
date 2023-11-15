<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardTransactionLog extends Model
{
    use HasFactory;
    protected $casts = [
        'response' => 'array'
    ];

    protected $fillable = [
        'addressID',
        'amount',
        'uniquePaymentID',
        'token',
        'response',
        'type',
    ];
}
