<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class WebController extends Controller
{
    //
    public function index()
    {

        $highlight = Post::where('highlight_post', '0')->take(3)->get();
        $new = Post::where('new_post', '1')->take(10)->get();
        return view("web.home", compact("highlight", "new"));
    }
}
