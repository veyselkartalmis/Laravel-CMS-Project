<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pages;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["page"] = Pages::all()->sortBy("page_must");
        return view("backend.pages.index",compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.pages.create");
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
        if(strlen($request->page_slug)>3){
            $slug = Str::slug($request->page_slug);
        } else{
            $slug = Str::slug($request->page_title);
        }

        $validate = $request->validate([
            "page_title" => "required",
            "page_content" => "required",
            "page_file" => "required|image|mimes:jpg,jpeg,png|max:2048"
        ]);

        if($validate){
            $file_name = uniqid() . "." . $request->page_file->getClientOriginalExtension();
            $request->page_file->move(public_path("images/pages"), $file_name);
            $request->page_file = $file_name;
            //VERİTABANINA KAYDETME İŞLEMİNİ GERÇEKLEŞTİRİYORUM
            $page = Pages::insert([
                "page_title" => $request->page_title,
                "page_slug" => $slug,
                "page_file" => $request->page_file,
                "page_content" => $request->page_content,
                "page_status" => $request->page_status
            ]);
        }

      //EKLEME İŞLEMİNİN KONTROLÜNÜ GERÇEKLEŞTİRİYORUM
        if($page){
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
        $pages = Pages::where("id",$id)->first();
        return view("backend.pages.edit")->with("pages", $pages);
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
        if(strlen($request->page_slug)>3){
            $slug = Str::slug($request->page_slug);
        } else{
            $slug = Str::slug($request->page_title);
        }

        $validate = $request->validate([
            "page_title" => "required",
            "page_content" => "required",
            "page_file" => "image|mimes:jpg,jpeg,png|max:2048"
        ]);

        if($validate){
            if(isset($request->page_file)){
                $file_name = uniqid() . "." . $request->page_file->getClientOriginalExtension();
                $request->page_file->move(public_path("images/pages"), $file_name);
                $request->page_file = $file_name;
            }
            else{
                $request->page_file = $request->old_file;
            }
            //VERİTABANINA GÜNCELLEMEYİ KAYDETME İŞLEMİNİ GERÇEKLEŞTİRİYORUM
            $page = Pages::where("id",$id)->update([
                "page_title" => $request->page_title,
                "page_slug" => $slug,
                "page_file" => $request->page_file,
                "page_content" => $request->page_content,
                "page_status" => $request->page_status
            ]);
        }

        //GÜNCELLEME İŞLEMİNİN KONTROLÜNÜ GERÇEKLEŞTİRİYORUM
        //EĞER ESKİ RESİM VARSA VE ŞİMDİ YENİ RESİM EKLENMİŞ İSE ESKİYİ SİLME İŞLEMİ YAPIYORUM
        if($request->has("old_file") && $request->has("blog_file")){
            //ESKİ RESİMİN OLUP OLMADIĞINI SORGULATIP SİLME İŞLEMİNİ GERÇEKLEŞTİRİYORUM
            $path = "images/pages/".$request->old_file;
            if(file_exists($path)){
                @unlink(public_path($path));
            }
        }

        //İŞLEMİN BAŞARILI OLUP OLMADIĞINI KONTROL EDİYORUM
        if($page){
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
        $page = Pages::find(intval($id));
        if($page->delete()){
            echo 1;
        }
        echo 0;
    }

    // SIRALAMA İŞLEMİ İÇİN GEREKLİ KODUMU YAZIYORUM
    public function sortable()
    {
        foreach ($_POST['item'] as $key => $value)
        {
            $page=Pages::find(intval($value));
            $page->page_must=intval($key);
            $page->save();
        }
        echo true;
    }
}
