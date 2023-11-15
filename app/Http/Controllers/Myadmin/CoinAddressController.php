<?php

namespace App\Http\Controllers\Myadmin;

use App\Helpers\CoinPrice;
use App\Http\Controllers\Controller;
use App\Models\Coin;
use App\Models\CoinAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoinAddressController extends Controller
{
    public function items()
    {
        $array = CoinAddress::all();
        return response()->json($array);
    }

    public function info(Request $request)
    {
        $id = $request->id;
        $array = CoinAddress::where('id', $id)->first();
        return response()->json($array);
    }

    public function edit($id, Request $request)
    {
        $file_input_name = 'image';

        $fields = $request->all();

        //Photo upload
        unset($fields[$file_input_name]);

        CoinAddress::where('id', $id)->update($fields);
        $fields['id'] = $id;

        $user_data = CoinAddress::where('id', $id)->first();
        $fields[$file_input_name] = $user_data[$file_input_name];


        return response()->json($fields);
    }

    public function balance($id, Request $request)
    {
        $id = intval($id);
        $amount = $request->amount;

        // Validation
        if ( !is_numeric($amount) ) return 'Error: amount is not numeric';
        if ( $amount <= 0 ) return 'Error: amount must be greater than zero';

        $result = CoinAddress::addBalance($id, $amount, 'usd', 'Admin - Add Balance', get_class($this).'\\'.__FUNCTION__);
        
        // addBalance returns object for successful transaction, otherwise return the error
        if (!is_object($result)) return $result;

        $fields['id'] = $id;
        $fields['amount'] = $result->coinAmount;
        return response()->json($fields);
    }

    public function add(Request $request)
    {
        $fields = $request->all();

        $file_input_name = 'image';
        unset($fields[$file_input_name]);


        $mysql_data = $fields;
        $mysql_data['position'] = 0;
        $mysql_data['status'] = 1;

        $data = CoinAddress::create($mysql_data);
        $id = $data->id;


        $fields["id"] = $id;

        return response()->json($fields);
    }


    public function delete(Request $request)
    {
        $id = intval($request->id);
        $data = CoinAddress::where('id', $id)->first();

        $image_url = $data->image;
        $image_url = preg_replace('/storage/','public', $image_url);
        Storage::delete($image_url);

        $res = CoinAddress::where('id', $id)->delete();

        return $res;
    }

    public function price()
    {
        return Coin::price();
    }

}
