<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $USER = Auth::user();
        $USER = $USER->usertype->groupBy('User_Type_ID');
        if(isset($USER[2])) //customer
        {
            return $next($request);
        }
        return redirect()->back();
    }
}
