<?php

namespace App\Http\Controllers\Auth;

use App\Emails;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Type_Of_User;
use App\User;
use App\User_Type;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

class   LoginControllerUser extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest.user')->except('logout');
    }

    public function loginViaEmail()
    {
        $email=request('email');
        $password=request('password');

        if ($emailModel = Emails::all()->where('email', $email)->first())
        {
            if( Count(Type_Of_User::all()->where('User_ID',$emailModel->User_ID)->where('User_Type_ID',2))>0);
            return $this->login($emailModel->User_ID, $password);

        }

        return 'False';
    }

    public function login($id, $password)
    {
        $user = User::find($id);

        if(Hash::check($password, $user->password))
        {
            Auth::loginUsingId($id);
            return redirect()->route('CustomerHome');
        }

        return redirect()->back()->with('error','Wrong Email Or Password');
    }


}
