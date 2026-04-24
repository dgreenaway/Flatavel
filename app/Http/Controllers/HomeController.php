<?php

namespace App\Http\Controllers;

use App\Models\Post;

// Handles the homepage. Separate from PostController because the homepage
// shows a limited preview of posts rather than the full list.

class HomeController
{
    public function index()
    {
        // array_slice grabs just the first 3 posts from the full sorted list.
        // Post::all() already sorts newest first so I get the 3 latest.
        $posts = array_slice(Post::all(), 0, 3);

        return view('home', ['posts' => $posts]);
    }
}
