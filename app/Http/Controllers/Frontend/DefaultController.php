<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Settings;
use Illuminate\Http\Request;
use App\Sliders;
use App\Blogs;
use Illuminate\Support\Facades\Mail;

class DefaultController extends Controller
{
    public function index()
    {
        $data["blog"] = Blogs::all()->sortBy("blog_must");
        $data["slider"] = Sliders::all()->sortBy("slider_must");
        return view("frontend.default.index", compact("data"));
    }

    public function contact()
    {
        $veri["settings"] = Settings::all();
        return view("frontend.default.contact", compact("veri"));
    }

    public function sendMail(Request $request)
    {
        $data = [
          "name" => $request->name,
          "email" => $request->email,
          "phone" => $request->phone,
          "message" => $request->message
        ];

        //GO TO .env AND ENTER YOUR MAIL VALUE
        Mail::to("veyselkartalms@gmail.com")->send(new SendMail($data));
        return back();
    }
}
