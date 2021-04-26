<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $reponse = Http::post(env('OAUTH_URL'), [
                'grant_type' => 'password',
                'client_id' => env('CLIENT_ID'),
                'client_secret' => env('CLIENT_SECRET'),
                'username' => $request->username,
                'password' => $request->password,
            ]);

            return $reponse->getBody();

        } catch (\Exception $e) {
            if ($e->getCode() == 400) {
                return response()->json("Invalid request. Please enter username and password.", $e->getCode());
            } elseif ($e->getCode() == 401) {
                return response()->json('Your credentials are incorrent. Please try again', $e->getCode());
            }

            return response()->json('Something went wrong.', $e->getCode());
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens->each( function ($token, $key){
            $token->delete();
        });

        return response()->json('Logged out successfully', 200);
    }
}
