<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

// Handles the site settings form in the admin area.
// Settings are stored as a JSON file rather than in a database.
// The AppServiceProvider reads this file on boot and shares the values
// with every view automatically via View::share().

class SettingsController
{
    public function index()
    {
        $path = base_path('content/settings.json');

        // Fall back to an empty array if the file doesn't exist yet
        // so the form doesn't break on a fresh install.
        $settings = File::exists($path)
            ? json_decode(File::get($path), true)
            : [];

        return view('admin-settings', ['settings' => $settings]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'site_name'      => 'required|string|max:100',
            'site_tagline'   => 'nullable|string|max:100',
            'footer_text'    => 'nullable|string|max:200',
            // header_scripts has no max length because analytics snippets can be long
            'header_scripts' => 'nullable|string',
        ]);

        $settings = [
            'site_name'      => $request->site_name,
            'site_tagline'   => $request->site_tagline,
            'footer_text'    => $request->footer_text,
            'header_scripts' => $request->header_scripts,
        ];

        // JSON_PRETTY_PRINT keeps the file readable if I ever edit it manually
        File::put(base_path('content/settings.json'), json_encode($settings, JSON_PRETTY_PRINT));

        return redirect('/admin/settings')->with('success', 'Settings saved.');
    }
}
