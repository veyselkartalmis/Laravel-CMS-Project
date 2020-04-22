<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        //GİREN KİŞİNİN OLUP OLMADIĞI VE ADMİN ROLUNDE OLUP OLMADIĞINI SORGULATIYORUM
        if(!\Auth::guest() && \Auth::user()->role == "admin"){
            return $next($request);
        } else{
            return redirect(route("nedmin.Login"))->with("error","You are not authorized to login!");
        }

        return redirect(route("nedmin.Login"));
    }
}
