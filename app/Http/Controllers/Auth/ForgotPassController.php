<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class ForgotPassController extends Controller
{
    public function requestPassword(Request $request){
        if($request->has('locale')){
            $locale = $request->get('locale');

            if(in_array($locale, ['en', 'id'])){
                App::setLocale($locale);
                Session::put('locale', $locale);
            }
        }

        return view('auth.forgot-password');
    }

    public function sendEmail(Request $request){
        $request->validate([
            'email' => 'required|email'
        ]);

        $response = Password::sendResetLink($request->only('email'));

        return $response === Password::RESET_LINK_SENT ? back()->with('status', __($response)) : back()->withErrors(['email' => __($response)]);
    }
}
