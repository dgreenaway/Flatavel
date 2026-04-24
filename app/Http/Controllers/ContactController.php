<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ContactController
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'message' => 'required|string|max:2000',
        ]);

        $data = [
            'name'    => $request->name,
            'email'   => $request->email,
            'message' => $request->message,
            'date'    => now()->toDateTimeString(),
        ];

        $filename = now()->format('Y-m-d_H-i-s') . '.json';
        File::put(base_path('content/messages/' . $filename), json_encode($data, JSON_PRETTY_PRINT));

        return redirect('/contact')->with('success', 'Message sent!');
    }
}
