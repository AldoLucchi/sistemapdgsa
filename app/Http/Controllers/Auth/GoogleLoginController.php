<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Log;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        Log::info('GoogleLoginController - redirectToGoogle');

        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        Log::info('GoogleLoginController - GoogleCallback');


        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $googleUser->email)->first();

        /*
        //si el user no existe en base de datos, lo registra        
        if(!$user)
        {
            $user = User::create(['name' => $googleUser->name, 'email' => $googleUser->email, 'password' => \Hash::make(rand(100000,999999))]);
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
        */

        //solo para users existentes en base de datos
        
        if($user)
        {
            Auth::login($user);
            return redirect(RouteServiceProvider::HOME);
        }
        
        return redirect('/login')->withErrors(['msg' => 'Cuenta inexistente']);  
        
    }
}