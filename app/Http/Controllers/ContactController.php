<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

// Handles the contact form. Instead of sending emails (which needs SMTP config)
// I'm saving messages as JSON files in content/messages/. This keeps things
// simple and means I can read them in the admin area without a database.

class ContactController
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        // Validate the form fields before doing anything.
        // Laravel redirects back with errors automatically if validation fails.
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'message' => 'required|string|max:2000',
        ]);

        $data = [
            'name'    => $request->name,
            'email'   => $request->email,
            'message' => $request->message,
            // now() is a Laravel helper for the current date/time
            'date'    => now()->toDateTimeString(),
        ];

        // Using a timestamp as the filename means each message is unique
        // and they sort chronologically which is useful in the admin area.
        $filename = now()->format('Y-m-d_H-i-s') . '.json';
        File::put(base_path('content/messages/' . $filename), json_encode($data, JSON_PRETTY_PRINT));

        // with() flashes a success message to the session for one request only.
        return redirect('/contact')->with('success', 'Message sent!');
    }
}
