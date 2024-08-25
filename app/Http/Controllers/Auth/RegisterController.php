<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function registerForm(Request $request){
        if($request->has('locale')){
            $locale = $request->get('locale');

            if(in_array($locale, ['en', 'id'])){
                App::setLocale($locale);
                Session::put('locale', $locale);
            }
        }
        
        return view('auth.register');
    }

    public function register(Request $request){
        $checker = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:clients',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $client = Client::create([
            'name' => $checker['name'],
            'email' => $checker['email'],
            'password' => Hash::make($checker['password']),
        ]);

        Auth::login($client);

        return redirect()->intended(route('index'));
    }
}
