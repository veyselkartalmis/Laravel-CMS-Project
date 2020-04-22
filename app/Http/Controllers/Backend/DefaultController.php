<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Attempting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DefaultController extends Controller
{
    public function index()
    {
        return view("backend.default.index");
    }

    public function login()
    {
        return view("backend.default.login");
    }

    public function auth(Request $request)
    {
        $request->flash();

        $credi = $request->only("email","password");
        $remember_me = $request->has("remember_me") ? true : false;

        //BURADA ATTEMPT METODUYLA KAYITLI KULLANICI VAR MI SORGULUYORUM
        if(Auth::attempt($credi,$remember_me)){
            //YAZILAN INTENTED KODU N11 BENZERİ SİTELERDE GİRİŞ YAPILMADAN SEPETE EKLENEN ÜRÜNÜ
            //GİRİŞ YAPILDIĞINDA TEKRAR SEPETTE GÖRÜNMESİNİ SAĞLAYAN, HAFIZA TAŞIYICI TARZI BİR OLAY
            return redirect()->intended(route("nedmin.Index"));
        } else{
            return back()->with("error", "Wrong username or password!");
        }
    }

    public function logOut()
    {
        //LOGOUT İŞLEMİ İÇİN BU KODU YAZMAMIZ YETERLİ, ROUTE YÖNLENDİR VE BUTONA HREF VER
        Auth::logout();
        return redirect(route("nedmin.Login"))->with("success","Successful");
    }
}
