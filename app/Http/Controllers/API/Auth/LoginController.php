<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

use Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    { 
        try {
            $this->validate($request, [
                'email' => 'required',
                'password' => 'required'
            ]);

            $user = User::where('email',$request->email)->first();
            if(!$user){
                return response([
                    "status" => 400,
                    "message"=> 'Pengguna tidak ditemukan!',
                ]);
            }

            if($user && Hash::check($request->password, $user->password)){
                $token = $user->createToken('api_laravel')->accessToken;

                return response([
                    "status"    => 200,
                    "data"      => [
                        'user' => $user,
                        'token' => $token
                    ],
                    "message"   => 'Login berhasil.'
                ], 200);
            }else{
                return response([
                    "status" => 400,
                    "message"=> 'Login gagal!',
                ]);
            }
        } catch (Exception $e) {
            return response([
                "status" => 400,
                "message"=> $e->getMessage(),
            ]);
        }
    }
}
