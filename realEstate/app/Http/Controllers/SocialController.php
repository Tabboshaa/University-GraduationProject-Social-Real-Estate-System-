<?php

namespace App\Http\Controllers;


use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($service){
        return Socialite::driver($service)->redirect();
    }

    public function callback($service){
        return $user= Socialite::driver($service)->user();
    }
}
