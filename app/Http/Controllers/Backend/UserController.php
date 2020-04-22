<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["user"] = Users::all()->sortBy("user_must");
        return view("backend.users.index",compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "name" => "required",
            "email" => "required|email",
            "user_file" => "required|image|mimes:jpg,jpeg,png|max:2048",
            "password" => "required|Min:6"
        ]);

        if($validate){
            $file_name = uniqid() . "." . $request->user_file->getClientOriginalExtension();
            $request->user_file->move(public_path("images/users"), $file_name);
            $request->user_file = $file_name;
            //VERİTABANINA KAYDETME İŞLEMİNİ GERÇEKLEŞTİRİYORUM
            $user = Users::insert([
                "name" => $request->name,
                "email" => $request->email,
                "user_file" => $request->user_file,
                "password" => Hash::make($request->password),
                "user_status" => $request->user_status
            ]);
        }

      //EKLEME İŞLEMİNİN KONTROLÜNÜ GERÇEKLEŞTİRİYORUM
        if($user){
            return back()->with("success","ADDED");
        } else{
            return back()->with("error","WRONG!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = Users::where("id",$id)->first();
        return view("backend.users.edit")->with("users", $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            "name" => "required",
            "email" => "required|email",
            "user_file" => "image|mimes:jpg,jpeg,png|max:2048",
//            "password" => "required|Min:6"
        ]);

        if($validate){
            if(isset($request->user_file)){
                $file_name = uniqid() . "." . $request->user_file->getClientOriginalExtension();
                $request->user_file->move(public_path("images/users"), $file_name);
                $request->user_file = $file_name;
            }
            else{
                $request->user_file = $request->old_file;
            }
            //VERİTABANINA GÜNCELLEMEYİ KAYDETME İŞLEMİNİ GERÇEKLEŞTİRİYORUM IF YAPISINA GÖRE
            if(strlen($request->password) > 0){
                $request->validate([
                    "password" => "required|Min:6"
                ]);
                $user = Users::where("id",$id)->update([
                    "name" => $request->name,
                    "email" => $request->email,
                    "user_file" => $request->user_file,
                    "password" => Hash::make($request->password),
                    "user_status" => $request->user_status
                ]);
            } else{
                $user = Users::where("id",$id)->update([
                    "name" => $request->name,
                    "email" => $request->email,
                    "user_file" => $request->user_file,
                    "user_status" => $request->user_status
                ]);
            }
        }

        //GÜNCELLEME İŞLEMİNİN KONTROLÜNÜ GERÇEKLEŞTİRİYORUM
        //EĞER ESKİ RESİM VARSA VE ŞİMDİ YENİ RESİM EKLENMİŞ İSE ESKİYİ SİLME İŞLEMİ YAPIYORUM
        if($request->has("old_file") && $request->has("user_file")){
            //ESKİ RESİMİN OLUP OLMADIĞINI SORGULATIP SİLME İŞLEMİNİ GERÇEKLEŞTİRİYORUM
            $path = "images/users/".$request->old_file;
            if(file_exists($path)){
                @unlink(public_path($path));
            }
        }

        //İŞLEMİN BAŞARILI OLUP OLMADIĞINI KONTROL EDİYORUM
        if($user){
            return back()->with("success","UPDATED");
        } else{
            return back()->with("error","WRONG!");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $user = Users::find(intval($id));
        if($user->delete()){
            echo 1;
        }
        echo 0;
    }

    // SIRALAMA İŞLEMİ İÇİN GEREKLİ KODUMU YAZIYORUM
    public function sortable()
    {
        foreach ($_POST['item'] as $key => $value)
        {
            $user=Users::find(intval($value));
            $user->user_must=intval($key);
            $user->save();
        }
        echo true;
    }
}
