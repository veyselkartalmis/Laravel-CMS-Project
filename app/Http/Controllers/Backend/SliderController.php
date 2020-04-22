<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sliders;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["slider"] = Sliders::all()->sortBy("slider_must");
        return view("backend.sliders.index",compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.sliders.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //SEF LİNK KONTROLÜ YAPIYORUM, VERİLEN DEĞER YOKSA BAŞLIĞI SEF LİNKE ÇEVİRİYORUM
        if(strlen($request->slider_slug)>3){
            $slug = Str::slug($request->slider_slug);
        } else{
            $slug = Str::slug($request->slider_title);
        }

        $validate = $request->validate([
            "slider_title" => "required",
            "slider_content" => "required",
            "slider_file" => "required|image|mimes:jpg,jpeg,png|max:2048",
            "slider_url" => "active_url"
        ]);

        if($validate){
            $file_name = uniqid() . "." . $request->slider_file->getClientOriginalExtension();
            $request->slider_file->move(public_path("images/sliders"), $file_name);
            $request->slider_file = $file_name;
            //VERİTABANINA KAYDETME İŞLEMİNİ GERÇEKLEŞTİRİYORUM
            $slider = Sliders::insert([
                "slider_title" => $request->slider_title,
                "slider_slug" => $slug,
                "slider_file" => $request->slider_file,
                "slider_url" => $request->slider_url,
                "slider_content" => $request->slider_content,
                "slider_status" => $request->slider_status
            ]);
        }

      //EKLEME İŞLEMİNİN KONTROLÜNÜ GERÇEKLEŞTİRİYORUM
        if($slider){
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
        $sliders = Sliders::where("id",$id)->first();
        return view("backend.sliders.edit")->with("sliders", $sliders);
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
        //SEF LİNK KONTROLÜ YAPIYORUM, VERİLEN DEĞER YOKSA BAŞLIĞI SEF LİNKE ÇEVİRİYORUM
        if(strlen($request->slider_slug)>3){
            $slug = Str::slug($request->slider_slug);
        } else{
            $slug = Str::slug($request->slider_title);
        }

        $validate = $request->validate([
            "slider_title" => "required",
            "slider_content" => "required",
            "slider_file" => "image|mimes:jpg,jpeg,png|max:2048",
            "slider_url" => "active_url"
        ]);

        if($validate){
            if(isset($request->slider_file)){
                $file_name = uniqid() . "." . $request->slider_file->getClientOriginalExtension();
                $request->slider_file->move(public_path("images/sliders"), $file_name);
                $request->slider_file = $file_name;
            }
            else{
                $request->slider_file = $request->old_file;
            }
            //VERİTABANINA GÜNCELLEMEYİ KAYDETME İŞLEMİNİ GERÇEKLEŞTİRİYORUM
            $slider = Sliders::where("id",$id)->update([
                "slider_title" => $request->slider_title,
                "slider_slug" => $slug,
                "slider_file" => $request->slider_file,
                "slider_url" => $request->slider_url,
                "slider_content" => $request->slider_content,
                "slider_status" => $request->slider_status
            ]);
        }

        //GÜNCELLEME İŞLEMİNİN KONTROLÜNÜ GERÇEKLEŞTİRİYORUM
        //EĞER ESKİ RESİM VARSA VE ŞİMDİ YENİ RESİM EKLENMİŞ İSE ESKİYİ SİLME İŞLEMİ YAPIYORUM
        if($request->has("old_file") && $request->has("slider_file")){
            //ESKİ RESİMİN OLUP OLMADIĞINI SORGULATIP SİLME İŞLEMİNİ GERÇEKLEŞTİRİYORUM
            $path = "images/sliders/".$request->old_file;
            if(file_exists($path)){
                @unlink(public_path($path));
            }
        }

        //İŞLEMİN BAŞARILI OLUP OLMADIĞINI KONTROL EDİYORUM
        if($slider){
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
        $slider = Sliders::find(intval($id));
        if($slider->delete()){
            echo 1;
        }
        echo 0;
    }

    // SIRALAMA İŞLEMİ İÇİN GEREKLİ KODUMU YAZIYORUM
    public function sortable()
    {
        foreach ($_POST['item'] as $key => $value)
        {
            $slider=Sliders::find(intval($value));
            $slider->slider_must=intval($key);
            $slider->save();
        }
        echo true;
    }
}
