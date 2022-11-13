<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    function register(Request $request)
    {
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
        ];

        $user = User::create($input);

        $data = [
            'message' => 'User is created successfully'
        ];

        // Mengirim respon JSON
        return response()->json($data,201);
    }

    function login(Request $request)
    {
        $input = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($input)) {
            $token = Auth::user()->createToken('auth_token');

            $data = [
                'message' => 'Login successfully',
                'token' => $token->plainTextToken
            ];
            return response()->json($data,200);
        } else {
            $data = [
                'message' => 'Username or Password is wrong'
            ];

            return response()->json($data,401); 
        }

        // get data user
        // $user = User::where('email',$input['email'])->first();

        // Membandingkan input user dengan data user (DB)
        // $isLoginSuccessfully = (
        //     $input['email'] == $user->email && \Hash::check($input['password'], $user->password)
        // );

        // if ($isLoginSuccessfully) {
        //     // create token
        //     $token = $user->createToken('auth_token');

        //     $data = [
        //         'message' => 'Login successfully',
        //         'token' => $token->plainTextToken
        //     ];

        //     return response()->json($data,200);
        // } else {
        //     $data = [
        //         'message' => 'Username or Password is wrong'
        //     ];

        //     return response()->json($data,401); 
        // }
    }
}
