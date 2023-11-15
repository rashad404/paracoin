<?php

namespace App\Http\Controllers;

use App\Helpers\ViewCache;
use App\Models\Seo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        $data = Seo::getInstance()->index();

        ViewCache::create(
            view('vue.auth.index')->with($data)
        );
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'min:3', 'max:50'],
            'password' => ['required', 'min:3', 'max:200'],
        ]);

        $userData = array(
            'email' => $request->input('email'),
            'password' => $request->input('password')
        );

        if (Auth::attempt($userData)){

            $response = [
                'id' => Auth::id()
            ];

            return response()->json($response);

        }else{
            $response = [
                'auth'  => 'E-mail or password is incorrect'
            ];
            return response()->json($response, 422);
        }
    }

    public function registration(Request $request)
    {
        $error = '';
        $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'email' => ['required', 'min:3', 'max:50'],
            'password' => ['required', 'min:3', 'max:200'],
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $check = User::where('email', '=', $email)->first();
        if ($check){
            $error .= 'E-mail already registered.';
        }

        if(!empty($error)){
            $response = [
                'auth'  => $error
            ];
            return response()->json($response, 422);
        }else{
            $insert_id = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
            ]);


            if($insert_id['id']>0) {
                $userdata = array(
                    'email' => $email,
                    'password' => $password
                );
                Auth::attempt($userdata);

                $response = [
                    'id' => $insert_id['id']
                ];

                return response()->json($response);
            }else{
                $response = [
                    'errors'    =>  [
                        'auth'  => ['Registration DB error!']
                    ]
                ];
                return response()->json($response, 422);

            }

        }
    }

    public function logout(){

        Auth::logout();
        return redirect('/');
    }

}
