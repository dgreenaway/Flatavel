<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


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

    public function logout()
    {
        session()->forget('admin_authed');
        return redirect('/admin/login');
    }

    public function messages()
    {
        $files = File::files(base_path('content/messages'));

        $messages = collect($files)
            ->map(fn($file) => json_decode(File::get($file), true))
            ->sortByDesc('date')
            ->values()
            ->all();

        return view('admin-messages', ['messages' => $messages]);
    }
}
