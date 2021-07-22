<?php

namespace App\Http\Controllers\Auth;

use App\Emails;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
        $email = request('UserEmail');
        DB::beginTransaction();

        try {
            $useremail = Emails::all()->where('email', '=', $email)->first();

            $userID = $useremail->User_ID;
            $user = User::all()->find($userID);

            $newPassword = rand(1111111111, 9999999999);
            $PasswordHashed = Hash::make($newPassword);
            $user->password = $PasswordHashed;
            $user->save();
            Mail::to($email)->send(new \App\Mail\PasswordMail($newPassword));
            DB::commit();
            return view('website.frontend.forgotPassword');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return back()->with('error', 'Error editing Detail');
            }
            return back()->withError($e->getMessage())->withInput();
        }
    }
}
