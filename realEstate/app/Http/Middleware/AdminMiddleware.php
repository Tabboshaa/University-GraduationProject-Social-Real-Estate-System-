<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        try {
            $USER = Auth::user();
            $USER = $USER->usertype->groupBy('User_Type_ID');
            if (isset($USER[1])) //customer
            {
                return $next($request);
            }
            return redirect()->back();
        } catch (Exception $e) {
        return redirect()->route("login");       
      }
    }
}
