<?php

namespace App\Http\Controllers;

use App\Helpers\RequestHelper;
use App\Models\CardTransactionLog;
use App\Models\Coin;
use App\Models\CoinAddress;
use App\Models\Seo;
use Illuminate\Http\Request;
use Square\Models\CreatePaymentRequest;
use Square\SquareClient;
use Illuminate\Support\Str;
use Square\Models\Money;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{

    public function squarePay(Request $request)
    {
        $error = [];

        if (!CoinAddress::isAuth()) {
            $error = __('text.Please log in to continue.');
            return redirect(config('coin.folder') . '/login')->withErrors(["error" => $error]);
        }

        $getAddress = CoinAddress::getAddress();
        $address = $getAddress['address'];

        $data = Seo::getInstance()->index();
        $data += [
            'pageTitle' => 'Buy',
            'currentPrice' => Coin::price()
        ];
        return view('payments.'.__FUNCTION__)->with($data);
    }


    public function squareProcess(Request $request)
    {
        $amount = $request->input('amount');
        $token = $request->input('sourceId');
        $validator = Validator::make(
            $request->all(),
            [
                'amount' => 'bail|required|numeric|between:'.config('coin.minAmount').','.config('coin.maxAmount'),
                'sourceId' => 'bail|required|min:5|max:100'
            ]
        );

        if ($validator->fails()) {
            $validatorErrors = $validator->errors()->toArray();
            foreach ($validatorErrors as $validatorError) {
                $error = $validatorError[0];
            }
        }
        if (!empty($error)) {
            return [
                'success' => false, 
                'error' => true, 
                'errorMsg' => $error
            ];
        }

        $square_client = new SquareClient([
            'accessToken' => env('SQUARE_APP_TOKEN'),
            'environment' => env('SQUARE_ENVIRONMENT')
        ]);
        $payments_api = $square_client->getPaymentsApi();

        $money = new Money();
        $money->setAmount($amount * 100);
        $money->setCurrency('USD');
        
        $uniquePaymentID = Str::uuid();
        $getAddress = CoinAddress::getAddress();
        $addressID = $getAddress['id'];
        $cardTransactionLog = CardTransactionLog::create([
            'addressID'=> $addressID,
            'amount'=> $amount,
            'uniquePaymentID'=> $uniquePaymentID,
            'token'=> $token,
            'type'=> 'square',
        ]);
        // Every payment you process with the SDK must have a unique idempotency key.
        // If you're unsure whether a particular payment succeeded, you can reattempt
        // it with the same idempotency key without worrying about double charging
        // the buyer.
        $create_payment_request = new CreatePaymentRequest($token, $uniquePaymentID, $money);
        $response = $payments_api->createPayment($create_payment_request);
        if ($response->isSuccess()) {
            $addBalance = CoinAddress::addBalance($addressID, $amount, 'usd', 'Square - Add Balance', get_class($this).'\\'.__FUNCTION__);
            if (!is_object($addBalance)) {
                return [
                    'success' => false, 
                    'error' => true, 
                    'errorMsg' => $addBalance
                ];
            }

            $result = $response->getResult();
            CardTransactionLog::where('id', $cardTransactionLog->id)->update(['response' => json_encode($result)]);
            return [
                'success' => true, 
                'error' => false
            ];
        } else {
            $result = $response->getErrors();
            CardTransactionLog::where('id', $cardTransactionLog->id)->update(['response' => json_encode($result)]);
            return [
                'success' => false, 
                'error' => true, 
                'errorMsg' => $result
            ];
        }

    }

}