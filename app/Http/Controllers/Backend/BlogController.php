<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blogs;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["blog"] = Blogs::all()->sortBy("blog_must");
        return view("backend.blogs.index",compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.blogs.create");
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
        if(strlen($request->blog_slug)>3){
            $slug = Str::slug($request->blog_slug);
        } else{
            $slug = Str::slug($request->blog_title);
        }

        $validate = $request->validate([
            "blog_title" => "required",
            "blog_content" => "required",
            "blog_file" => "required|image|mimes:jpg,jpeg,png|max:2048"
        ]);

        if($validate){
            $file_name = uniqid() . "." . $request->blog_file->getClientOriginalExtension();
            $request->blog_file->move(public_path("images/blogs"), $file_name);
            $request->blog_file = $file_name;
            //VERİTABANINA KAYDETME İŞLEMİNİ GERÇEKLEŞTİRİYORUM
            $blog = Blogs::insert([
                "blog_title" => $request->blog_title,
                "blog_slug" => $slug,
                "blog_file" => $request->blog_file,
                "blog_content" => $request->blog_content,
                "blog_status" => $request->blog_status
            ]);
        }

      //EKLEME İŞLEMİNİN KONTROLÜNÜ GERÇEKLEŞTİRİYORUM
        if($blog){
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
        //EDIT BLADE'E ALINAN ID İLE BİRLİKTE VERİLERİ YOLLUYORUM
        $blogs = Blogs::where("id",$id)->first();
        return view("backend.blogs.edit")->with("blogs", $blogs);
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
        if(strlen($request->blog_slug)>3){
            $slug = Str::slug($request->blog_slug);
        } else{
            $slug = Str::slug($request->blog_title);
        }


        $validate = $request->validate([
            "blog_title" => "required",
            "blog_content" => "required",
            "blog_file" => "image|mimes:jpg,jpeg,png|max:2048"
        ]);

        if($validate){
            if(isset($request->blog_file)){
                $file_name = uniqid() . "." . $request->blog_file->getClientOriginalExtension();
                $request->blog_file->move(public_path("images/blogs"), $file_name);
                $request->blog_file = $file_name;
            }
            else{
                $request->blog_file = $request->old_file;
            }
            //VERİTABANINA GÜNCELLEMEYİ KAYDETME İŞLEMİNİ GERÇEKLEŞTİRİYORUM
            $blog = Blogs::where("id",$id)->update([
                "blog_title" => $request->blog_title,
                "blog_slug" => $slug,
                "blog_file" => $request->blog_file,
                "blog_content" => $request->blog_content,
                "blog_status" => $request->blog_status
            ]);
        }

        //GÜNCELLEME İŞLEMİNİN KONTROLÜNÜ GERÇEKLEŞTİRİYORUM
        //EĞER ESKİ RESİM VARSA VE ŞİMDİ YENİ RESİM EKLENMİŞ İSE ESKİYİ SİLME İŞLEMİ YAPIYORUM
        if($request->has("old_file") && $request->has("blog_file")){
            //ESKİ RESİMİN OLUP OLMADIĞINI SORGULATIP SİLME İŞLEMİNİ GERÇEKLEŞTİRİYORUM
            $path = "images/blogs/".$request->old_file;
            if(file_exists($path)){
                @unlink(public_path($path));
            }
        }

        //İŞLEMİN BAŞARILI OLUP OLMADIĞINI KONTROL EDİYORUM
        if($blog){
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
        $blog = Blogs::find(intval($id));
        if($blog->delete()){
            echo 1;
        }
        echo 0;
    }

    // SIRALAMA İŞLEMİ İÇİN GEREKLİ KODUMU YAZIYORUM
    public function sortable()
    {
        foreach ($_POST['item'] as $key => $value)
        {
            $blog=Blogs::find(intval($value));
            $blog->blog_must=intval($key);
            $blog->save();
        }
        echo true;
    }
}
