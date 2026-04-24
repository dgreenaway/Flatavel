<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController
{
    public function index()
    {
        return view('admin');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:md,txt',
        ]);

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        $file->move(base_path('content/posts'), $filename);

        return redirect('/admin')->with('success', 'Post uploaded: ' . $filename);
    }
}
