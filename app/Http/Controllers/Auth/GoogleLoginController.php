<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Services\BitacoraService;
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

        $bitacoraService = new BitacoraService();
        $sysdate = date('Y-m-d H:i:s');

        if($user)
        {
            Auth::login($user);            

            $data = [
                'idaccion' => 4, //login
                'descripcion' => 'login exitoso '.$googleUser->email,
                'ip' => $this->getIP(),
                'fecha' => $sysdate,
                'tabla' => 'users',
                'id' => $user->id,
                'campoid' => 'id',
            ];
            
            $bitacoraService->insertBitacora($data);

            return redirect(RouteServiceProvider::HOME);
        }

        $data = [
            'idaccion' => 4, //login
            'descripcion' => 'Error Login '.$googleUser->email,
            'ip' => $this->getIP(),
            'fecha' => $sysdate,
            'tabla' => 'users',
        ];
        
        $bitacoraService->insertBitacora($data);
        
        return redirect('/login')->withErrors(['msg' => 'Cuenta inexistente']);  
        
    }

    public function getIP(){
        $ip = '';
        if (isset($_SERVER['SERVER_ADDR'])) {
            $ip = $_SERVER['SERVER_ADDR'];
        } elseif (isset($_SERVER['LOCAL_ADDR'])) {
            $ip = $_SERVER['SERVER_ADDR'];
        }

        return $ip;
    }
}