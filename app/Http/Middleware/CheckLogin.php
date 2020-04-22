<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        //BURADA EĞER KULLANICI LOGIN YAPMIŞ İSE TEKRAR LOGIN SAYFASINA GİRMESİNİ ENGELLİYORUM
        if(\Auth::guest()){
            return $next($request);
        } else{
            return redirect(route("nedmin.Index"));
        }
    }
}
