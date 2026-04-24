<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController
{
    public function index()
    {
        $posts = array_slice(Post::all(), 0, 3);

        return view('home', ['posts' => $posts]);
    }
}
