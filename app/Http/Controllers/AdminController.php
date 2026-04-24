<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController
{
    public function index()
    {
        return view('admin');
    }

    public function login()
    {
        return view('admin-login');
    }

    public function loginPost(Request $request)
    {
        if ($request->password === env('ADMIN_PASSWORD')) {
            session(['admin_authed' => true]);
            return redirect('/admin');
        }

        return back()->withErrors(['password' => 'Incorrect password']);
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
