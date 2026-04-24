<?php

namespace App\Http\Controllers;

use App\Models\Post;

// Handles the public-facing blog post pages.
// I don't need the full Illuminate Controller base class here because
// I'm not using any of its helpers like middleware() or validate().

class PostController
{
    // Shows the full list of posts. Post::all() returns them newest first.
    public function index()
    {
        return view('index', [
            'posts' => Post::all(),
        ]);
    }

    // Shows a single post. The slug comes from the URL, e.g. /posts/hello-world.
    // Laravel automatically passes {slug} from the route into this method.
    public function show(string $slug)
    {
        return view('show', [
            'post' => Post::find($slug),
        ]);
    }
}
