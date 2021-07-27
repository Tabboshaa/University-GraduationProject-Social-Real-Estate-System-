<?php

namespace App\Http\Controllers\Auth;

use App\Emails;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Type_Of_User;
use App\User;
use App\User_Type;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;


class LoginController extends Controller
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
        $this->middleware('guest')->except('logout');
    }

    public function loginViaEmailAdmin()
    {


        $email=request('email');
        $password=request('password');

try{
        if ($emailModel = Emails::all()->where('email', $email)->first())
        {

            if( Count(Type_Of_User::all()->where('User_ID',$emailModel->User_ID)->where('User_Type_ID','=',1))>0){

            return $this->login($emailModel->User_ID, $password);
            }
            return redirect()->back()->with('error','This Email is Not Registered ');

        }

        return redirect()->back()->with('error','This Email is Not Admin Email ');
    }
    catch (\Exception $e) {
        return back()->withError($e->getMessage())->withInput();    
}
    }

    public function login($id, $password)
    {

        $user = User::find($id);

        if(Hash::check( $password, $user->password))
        {

           try {
               Auth::loginUsingId($id);
               return redirect()->route('AdminProfile');
           }catch (\Exception $e){
               DB::rollBack();
               return back()->withError($e->getMessage())->withInput();
           }

        }

        return false;
    }




}
