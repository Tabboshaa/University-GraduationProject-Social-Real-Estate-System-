<?php

namespace App\Http\Controllers\Auth;

use App\Emails;
use App\Http\Controllers\Controller;
use App\Phone_Numbers;
use App\Providers\RouteServiceProvider;
use App\Type_Of_User;
use App\User;
use App\ProfilePhoto;
use http\Env\Request;
use http\Url;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
     protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest.user');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create()
    {
        $user=User::create(['password' => Hash::make(request('password'))]);

        $user_Id= Arr::get($user, 'id');

        $Email=Emails::create([
            'User_ID'=>$user_Id,
            'email' => request()['email']
        ]);

        $user_type = Type_Of_User::create([
            'User_ID' => $user_Id,
            'User_Type_ID'=>2
        ]);

        //return redirect('/HomeRegister');
        return redirect()->route('HomeRegister');
    }

}
