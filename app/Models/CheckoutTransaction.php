<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CheckoutTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'to',
        'from',
        'amount',
        'customAmount',
        'info',
        'extraData',
        'orderToken',
        'completed',
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
    ];

    public static function process($to, $from, $amount, $orderToken) {
        $check = self::where('to', $to)
            ->where('amount', $amount)
            ->where('from', $from)
            ->where('orderToken', $orderToken)
            ->where('completed', false)
            ->first();
        if (!$check) {
            return ["error" => 'Transaction not found or duplicate!'];
        }

        DB::beginTransaction();
        try {
            $toQuery = CoinAddress::where('address', $to);
            $toQuery->increment('balance', $amount);

            $fromQuery = CoinAddress::where('address', $from);
            $fromQuery->decrement('balance', $amount);

            CoinTransaction::create([
                'to' => $to,
                'from' => $from,
                'amount' => $amount,
                'note' => $check['service'],
                'time' => time()
            ]);

            self::where('to', $to)
                ->where('amount', $amount)
                ->where('from', $from)
                ->where('orderToken', $orderToken)
                ->update(['completed' => true]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect(config('coin.folder') . '/checkout')
                ->withErrors(["error" => 'DB Error! Try again']);
        }

        return ['success' => true, 'error' => false];
    }
}
