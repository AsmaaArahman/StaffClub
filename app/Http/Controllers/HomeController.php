<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
        public function index() {
                $news= \App\Models\News::with("news_images")
                     ->where("active", "=", 1)
                     ->orderBy("created_at")
                     ->paginate(6)->all();

                return view("home")->with([
                        "news"=> $news,
                        "latest_one"=> $news? $news[0] : null
                ]);
                
        } 
}
