<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogUserOut
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
                $user= null;
                
                if(session()->get("login_role") == "mod") {

                        $user = \App\Models\Mod::find(session()->get("user")->id);
                        if($user) {
                                if($user->logout == 1) {
                                        session()->flush();
                                        return redirect("/admin/mods/login");
                                }else {
                                        return $next($request);
                                }   
                        } else {
                                session()->flush();
                                return redirect("/admin/mods/login");
                        }
                        
                }else if (session()->get("login_role") == "member") {
                        
                        $user = \App\Models\Member::find(session()->get("user")->id);
                        if($user) {
                                if($user->logout == 1) {
                                        session()->flush();
                                        return redirect("/login");
                                }else {
                                        
                                        return $next($request);
                                }   
                        } else {
                                session()->flush();
                                return redirect("/login");
                        }
                        
                }  
                
                return $next($request);
        }
}
