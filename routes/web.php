<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//YAZILAN RESOURCE ROUTE'U OTOMATİK OLARAK CRUD İŞLEM FONKSİYONLARINI CONTROLLERA GETİRİR
//NAMESPACELER ROUTELARI GRUPLAMAK İÇİN KULLANILDI TEKRAR TERKAR YOL BELİRTMEMEK İÇİN

Route::namespace("Frontend")->group(function(){
    //BLOG
    Route::get("/","DefaultController@index")->name("home.Index");
    Route::get("/blog","BlogController@index")->name("blog.Index");
    Route::get("/blog/{slug}","BlogController@detail")->name("blog.Detail");

    //PAGE
    Route::get("/page","PageController@index")->name("page.Index");
    Route::get("/page/{slug}","PageController@detail")->name("page.Detail");

    //CONTACT
    Route::get("/contact","DefaultController@contact")->name("contact.Detail");
    Route::post("/contact","DefaultController@sendMail");
});

Route::namespace("Backend")->group(function(){
    //DEFAULT SAYFALAR İÇİN OLUŞTURULAN ROUTE GRUBU
    Route::prefix("nedmin")->group(function () {
        Route::get("/dashboard","DefaultController@index")->name("nedmin.Index")->middleware("admin");
        Route::get("/","DefaultController@login")->name("nedmin.Login")->middleware("CheckLogin");
        Route::get("/logout","DefaultController@logOut")->name("nedmin.Logout");
        Route::post("/login","DefaultController@auth")->name("nedmin.Auth");
    });

    //SETTINGS İÇİN OLUŞTURULAN ROUTE GRUBU
    //GRUBA TOPLU OLARAK MIDDLEWARE ATAMASI GERÇEKLEŞTİRDİM
    Route::middleware(["admin"])->group(function () {
    Route::prefix("nedmin/settings")->group(function(){
        Route::get("/","SettingsController@index")->name("settings.Index");
        Route::post('',"SettingsController@sortable")->name('settings.Sortable');
        Route::get("/delete/{id}","SettingsController@destroy")->name("settings.Destroy");
        Route::get("/edit/{id}","SettingsController@edit")->name("settings.Edit");
        Route::post('/update/{id}',"SettingsController@update")->name('settings.Update');
        });
    });
});

Route::namespace("Backend")->group(function(){
    Route::prefix("nedmin")->group(function(){
        //ROUTELAR İÇİN TOPLU MIDDLEWARE YONLENDİRMESİ
        Route::middleware(["admin"])->group(function () {
        //BLOG
        Route::post('/blog/sortable',"BlogController@sortable")->name('blog.Sortable');
        Route::resource("blog","BlogController");

        //PAGE
        Route::post('/page/sortable',"PageController@sortable")->name('page.Sortable');
        Route::resource("page","PageController");

        //SLIDER
        Route::post('/slider/sortable',"SliderController@sortable")->name('slider.Sortable');
        Route::resource("slider","SliderController");

        //USER
        Route::post('/user/sortable',"UserController@sortable")->name('user.Sortable');
        Route::resource("user","UserController");
        });
    });
});

Auth::routes();
