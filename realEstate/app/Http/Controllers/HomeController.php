<?php

namespace App\Http\Controllers;

use App\Emails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('website/backend.database pages.Data_Type');
        return view('home');
    }

    public function contactUs()
    {
        $text=\request('text');
        $email=Emails::all()->where('User_ID','=',Auth::id())->first();
        \Mail::to('abdalaziztabbosha@gmail.com')->send(new \App\Mail\mailus($text));
        return redirect()->back();
    }
}
