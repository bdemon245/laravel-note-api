<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    
    public function register(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        //create new token
        $token = $user->createToken('apiuser-' . $user->id);
        $content = [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];
        return response($content, 201);
    }

    public function login(Request $request)
    {
        //defining content status to return
        $content = null;
        $status = 200;


        //validate the form request
        try {
            $request->validate(
                [
                    "email" => "required|email",
                    "password" => "required",
                ]
            );
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors(),
            ], 433);
        }
        //collects user and checks if it is authenticated or not
        $user = User::where('email', $request->email)->first();
        $isAuth = Hash::check($request->password, $user->password);

        //validating user
        if (!$user) {
            $content = "User not found";
            $status = 404;
        } elseif (!$isAuth) {
            $content = "Credentials didn't match";
            $status = 404;
        } else {
            Auth::login($user);
            //deleting existing tokens
            $user->tokens()->delete();

            //create new token
            $token = $user->createToken('apiuser-' . $user->id);
            $content = [
                'data' => $user,
                'token' => $token->plainTextToken,
            ];
        }


        //returning responses
        return response($content, $status);
    }

    public function logout()
    {
        $user = User::findOrFail(auth('sanctum')->id());
        $user->tokens()->delete();

        return response()->json([
            'data' => 'Logged out',
        ], 200);
    }
}
