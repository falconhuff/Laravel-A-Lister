<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function loginForm(Request $request){
        if($request->has('locale')){
            $locale = $request->get('locale');

            if(in_array($locale, ['en', 'id'])){
                App::setLocale($locale);
                Session::put('locale', $locale);
            }
        }
        
        return view('auth.login');
    }

    public function login(Request $request){
        $validate = $request->only('email', 'password');

        $request->validate([
            'g-recaptcha-response' => 'required|string',
        ]);
        $recaptchaResponse = $request->input('g-recaptcha-response');

        $response = Http::post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.services_key'),
            'response' => $recaptchaResponse,
        ]);

        $recaptchaVerified = $response->json('success');

        if($recaptchaVerified){
            return back()->withErrors(['captcha' => 'CAPTCHA verification failed']);
        }

        if($request->remember){
            Cookie::queue('mycookie', $request->email, 5);
        }

        if(Auth::attempt($validate)){
            return redirect()->intended(route('index'));
        }

        //sleep(30);

        return back()->withErrors(['email' => 'Invalid data.']);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
