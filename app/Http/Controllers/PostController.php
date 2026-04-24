<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController
{
    public function index()
    {
        return view('index', [
            'posts' => Post::all(),
        ]);
    }

    public function show(string $slug)
    {
        return view('show', [
            'post' => Post::find($slug),
        ]);
    }
}
