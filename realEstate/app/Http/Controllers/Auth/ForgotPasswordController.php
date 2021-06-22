<?php

namespace App\Http\Controllers\Auth;

use App\Emails;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showForgotPassword()
    {
        return view('website.frontend.forgotPassword');
    }
    public function forgotPassword()
    {
        $email=request('UserEmail');

        $useremail=Emails::all()->where('email','=',$email)->first();

        $userID=$useremail->User_ID;
        $user=User::all()->find($userID);

        $newPassword = rand(1111111111,9999999999);
        $PasswordHashed=Hash::make($newPassword);
        $user->password=$PasswordHashed;
        $user->save();
        \Mail::to('abdalaziztabbosha@gmail.com')->send(new \App\Mail\PasswordMail($newPassword));
        return view('website.frontend.forgotPassword');
    }
}
