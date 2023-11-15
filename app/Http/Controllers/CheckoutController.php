<?php

namespace App\Http\Controllers;

use App\Helpers\RequestHelper;
use App\Helpers\Validate;
use App\Models\CheckoutSetting;
use App\Models\CheckoutTransaction;
use App\Models\CoinAddress;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function index($paraData = '')
    {
        $error = '';

        $paraDataArray = json_decode(base64_decode($paraData), true);
        $request = new Request($paraDataArray);

        $getAddress = CoinAddress::getAddress();

        $address = $getAddress['address'];
        $balance = $getAddress['balance'];

        if ($paraData) {
            $info = $request->info;
            $extraData = $request->extraData;
            $amount = $request->amount;
            $to = $request->receiver;
            $orderToken = $request->orderToken;
            $customAmount = $request->customAmount;
        }

        if ($address == $to) {
            $error = "You can't send coin to yourself";
        } else {
            $to_check = CoinAddress::where('address', $to)->first();
            if (!$to_check) {
                $error = "Receiver address is not found.";
            }
        }

        if (!$paraData) {
            $error = 'Wrong method';
        }
        if ($request->has('confirm')) {
            $error = 'Wrong Request';
        }


        // Transaction hasn't started yet.
        // We need to return errors to the merchant, instead of redirect.
        // And we reset the session
        session(['checkoutTransactionID' => false]);

        $validator = Validator::make(
            $request->all(),
            [
                'receiver' => 'bail|required|size:20',
                'amount' => 'bail|required|numeric|min:1|max:1000000',
                'orderToken' => 'bail|required|min:1|max:32',
                'info' => 'bail|required|max:100',
            ]
        );

        if ($validator->fails()) {
            $validatorErrors = $validator->errors()->toArray();
            foreach ($validatorErrors as $validatorError) {
                $error = $validatorError[0];
            }
        }

        $checkoutSetting = CheckoutSetting::getCheckoutSettings($to);
        if (!empty($error)) {
            return ['error' => $error];
        }


        $checkoutTransaction = CheckoutTransaction::where('amount', $amount)
            ->where('to', $to)
            ->where('from', $address)
            ->where('orderToken', $orderToken)
            ->where('customAmount', $customAmount)
            ->first();

        // If transaction exists, set checkoutTransactionID session from that record.
        if ($checkoutTransaction) {
            session(['checkoutTransactionID' => $checkoutTransaction->id]);
        } else {
            // Otherwise create a new transacion and set session.
            $newTransaction = CheckoutTransaction::create([
                'to' => $to,
                'amount' => $amount,
                'customAmount' => $customAmount,
                'from' => $address,
                'info' => $info,
                'extraData' => $extraData,
                'orderToken' => $orderToken,
                'time' => time()
            ]);
            session(['checkoutTransactionID' => $newTransaction->id]);
        }

        $data = Seo::getInstance()->index();
        $data['address'] = $address;
        $data['balance'] = $balance;
        $data['info'] = $info;
        $data['amount'] = $amount;
        $data['receiver'] = $to;
        $data['customAmount'] = $customAmount;
        $data['extraData'] = $extraData;

        return view('checkout.' . __FUNCTION__)->with($data);
    }


    public function view()
    {
        $checkoutTransactionID = session('checkoutTransactionID');

        $getAddress = CoinAddress::getAddress();
        $address = $getAddress['address'];
        $balance = $getAddress['balance'];

        $checkoutTransaction = CheckoutTransaction::where('id', $checkoutTransactionID)
        ->where('completed', 0)
        ->where('from', $address)
        ->first();

        if (!$checkoutTransaction) {
            $error[] = 'Transaction not found.';
        } else {
            $info = $checkoutTransaction['info'];
            $amount = $checkoutTransaction['amount'];
            $to = $checkoutTransaction['to'];
            $orderToken = $checkoutTransaction['orderToken'];
            $customAmount = $checkoutTransaction['customAmount'];
            $extraData = $checkoutTransaction['extraData'];
        }

        if (!empty($error)) {
            return ['error' => $error];
        }

        $data = Seo::getInstance()->index();
        $data['address'] = $address;
        $data['balance'] = $balance;
        $data['info'] = $info;
        $data['amount'] = $amount;
        $data['receiver'] = $to;
        $data['customAmount'] = $customAmount;
        $data['extraData'] = $extraData;

        return view('checkout.index')->with($data);
    }

    public function pay(Request $request)
    {
        $error = [];

        if (!CoinAddress::isAuth()) {
            $data = Seo::getInstance()->index();
            return view('checkout.login')->with($data);
        }

        $getAddress = CoinAddress::getAddress();
        $address = $getAddress['address'];

        $checkoutTransactionID = (int) session('checkoutTransactionID');
        if ($checkoutTransactionID <= 0) {
            $error = 'Wrong Transaction';
        }
        if (!$request->has('confirm')) {
            $error = 'Wrong Request';
        }

        $checkoutTransaction = CheckoutTransaction::where('id', $checkoutTransactionID)
            ->where('completed', 0)
            ->first();

        if (!$checkoutTransaction) {
            $error = 'Transaction not found';
        } else {
            $receiver = $checkoutTransaction->to;
            $from = $checkoutTransaction->from;
            $customAmount = $checkoutTransaction->customAmount;
            $amount = $checkoutTransaction->amount;
            $orderToken = $checkoutTransaction->orderToken;
            $extraData = $checkoutTransaction->extraData;

            // If merchant allows custom Amount, then get the amount from the request.
            if ($customAmount) {
                $amount = $request->amount;
            }

            if ($from != $address) {
                $error = 'Transaction started with different address.';
            }

            $validation = Validate::transfer($receiver, $amount);
            if ($validation['error']) {
                $error = $validation['error'];
            }
        }
        if (!empty($error)) {
            return redirect(config('coin.folder') . '/checkout')->withErrors(["error" => $error]);
        }

        $process = CheckoutTransaction::process($receiver, $address, $amount, $orderToken);
        if ($process['error']) {
            return redirect(config('coin.folder') . '/checkout')->withErrors(["error" => $process['error']]);
        }
        if ($process['success']) {
            $checkoutSetting = CheckoutSetting::getCheckoutSettings($receiver);
            // Send request to the callback URL.
            $data =  [
                'orderToken' => $orderToken,
                'receiver' => $receiver,
                'amount' => $amount,
                'extraData' => $extraData,
                'orderHash' => md5($orderToken . $receiver . $amount . $extraData . $checkoutSetting['privateToken']),
                'debugMode' => $checkoutSetting['debugMode']
            ];

            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';
            // echo 'pt: ' . $checkoutSetting['privateToken'] . '<br/>';
            $response = RequestHelper::post($checkoutSetting['callbackUrl'], $data);

            // echo '<pre>';
            // print_r($response);
            // echo '</pre>';
            // exit;
            if ($response['content'] == 1 && $response['statusCode'] == 200 && $response['error'] == '') {
                return redirect($checkoutSetting['resultUrl'] . '?success');
            } else {
                return redirect($checkoutSetting['resultUrl'] . '?error');
            }
        }
    }

    public function testPayment()
    {
        $data = Seo::getInstance()->index();
        $data += [
            'receiver' => 't5t5tbzz4y5z4uiw52zk',
            'orderToken' => rand(111111111, 999999999),
            'info' => 'Laptop',
            'customAmount' => 0,
        ];
        return view('checkout.' . __FUNCTION__)->with($data);
    }

    public function loginSubmit(Request $request)
    {
        $address = $request->input('address');
        $password = $request->input('password');

        $check = CoinAddress::login($address, $password);
        if ($check) {
            session(['address' => $address]);
            $checkoutTransactionID = session('checkoutTransactionID');
            CheckoutTransaction::where('id', $checkoutTransactionID)->update(['from' => $address]);
            return redirect(config('coin.folder') . '/checkout');
        } else {
            return redirect(config('coin.folder') . '/checkout')
            ->withErrors(["error" => __('text.Login or password is incorrect!')]);
        }
    }
}