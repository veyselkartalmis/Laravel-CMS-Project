<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pages;

class PageController extends Controller
{
    public function index()
    {
        $data["page"] = Pages::all()->sortBy("page_must");
        return view("frontend.pages.index", compact("data"));
    }
    public function detail($slug)
    {
        $lastPages = Pages::all()->sortBy("page_must");
        $page = Pages::where("page_slug",$slug)->first();
        return view("frontend.pages.detail",compact("page","lastPages"));
    }
}
