<?php

namespace App\Http\Controllers\Myadmin;

use App\Http\Controllers\Controller;
use App\Models\Myadmin\Admin;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{


    public function index(){
        $data = Seo::getInstance()->general();
        return view('my-admin/index')->with($data);

    }
    public function login(Request $request){
        $data = Seo::getInstance()->general();
        $request->validate([
            'email' => ['required', 'min:3', 'max:50'],
            'password' => ['required', 'min:3', 'max:200'],
            ]);



        $check = Admin::where('email', $request->email)->first();



        if(Hash::check($request->password, $check->password)){
            $response = [
                'id' => $check['id']
            ];

            return response()->json($response);
        }else{
            $response = [
                'errors'    =>  [
                    'auth'  => ['E-mail or password is incorrect']
                ]
            ];
            return response()->json($response, 422);
        }

    }
}
