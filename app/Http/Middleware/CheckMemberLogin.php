<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMemberLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
            if(!session()->has("user"))
            {
                    session()->flush();
                    return redirect("/login");
            }
            
            if(!session()->get("login_role") == "member") {
                    session()->flush();
                    return redirect("/login");
            } 
            
            
            return $next($request);
    }
}
