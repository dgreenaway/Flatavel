<?php

namespace App\Http\Controllers;

// Simple static page controller. No data to fetch so it just returns the view.
// I learned that even static pages go through a controller in Laravel rather
// than serving HTML files directly -- everything goes through the routing layer.

class AboutController
{
    public function index()
    {
        return view('about');
    }
}
