<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfMod
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
                        return redirect("/admin/mods/login");
                }
                
                if(!strcmp(session()->get("login_role"), "mod") == 0) {
                        session()->flush();
                        return redirect("/admin/mods/login");
                } 

                
                return $next($request);
    }
}
