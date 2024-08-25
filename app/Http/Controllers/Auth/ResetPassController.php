<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPassController extends Controller
{
    public function resetForm(Request $request, $token = null){
        return view('auth.reset-password')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function($client, $password){
                $client->password = Hash::make($password);
                $client->setRememberToken(Str::random(60));
                $client->save();
            } 
        );

        return $response === Password::PASSWORD_RESET ? redirect()->route('login')->with('status', __($response)) : back()->withErrors(['email' => [__($response)]]);
    }
}
