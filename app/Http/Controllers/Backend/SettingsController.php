<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Settings;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function index()
    {
        //OLUŞTURDUĞUM MODELDEN VERİLERİ SORT BY İLE SIRALAYARAK ALIYORUM VE BLADE'E YOLLUYORUM
        $data["adminSettings"] = Settings::all()->sortBy("settings_must");
        return view("backend.settings.index",compact("data"));
    }

    public function sortable()
    {
        foreach ($_POST['item'] as $key => $value)
        {
            $settings=Settings::find(intval($value));
            $settings->settings_must=intval($key);
            $settings->save();
        }
        echo true;
    }

    //YAZDIĞIM SCRIPT KODUNDAKİ ID'Yİ YAKALAYIP BURAYA ATIYORUM VE VERİTABANINDA SİLME İŞLEMİNİ YAPIYORUM
    public function destroy($id)
    {
        $delete = Settings::find($id);
        if($delete->delete()){
            return back()->with("success","Deleted");
        }
        return back()->with("error","Wrong");
    }

    //DÜZENLEME BLADE'INI AÇIP WHERE KOŞULUYLA ALDIĞIM DATALARI YOLLUYORUM
    public function edit($id)
    {
        $settings = Settings::where("id",$id)->first();
        return view("backend.settings.edit")->with("edit",$settings);
    }

    public function update(Request $request, $id)
    {
        // BURADA YÜKLENECEK RESİM İÇİN VALIDATE KURALLARIMI BELİRTİYORUM
        if($request->hasFile("settings_value")){
            $request->validate([
                "settings_value" => "required|image|mimes:jpg,jpeg,png|max:2048"
            ]);
            // DOSYANIN YOLUNU UNIQID KULLANARAK ALIYORUM
            $file_name = uniqid() . "." . $request->settings_value->getClientOriginalExtension();
            // DOSYAYI VERDİĞİM YOLA KOPYALIYORUM
            $request->settings_value->move(public_path("images/settings/"),$file_name);
            $request->settings_value = $file_name;
        }

        $settings = Settings::where("id",$id)->update(
            [
                "settings_value" => $request->settings_value
            ]
        );

        if($settings){
            //ESKİ RESİMİN OLUP OLMADIĞINI SORGULATIP SİLME İŞLEMİNİ GERÇEKLEŞTİRİYORUM
            $path = "images/settings/".$request->old_file;
            if(file_exists($path)){
                @unlink(public_path($path));
            }
            return back()->with("success","SAVED!");
        }
        return back()->with("error","WRONG");
    }
}
