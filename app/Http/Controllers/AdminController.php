<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use Illuminate\Support\Str;


// Handles everything in the admin area -- creating posts, editing posts,
// uploading images, viewing messages, and login/logout.

class AdminController
{
    public function index()
    {
        return view('admin');
    }

    // Shows the login form
    public function login()
    {
        return view('admin-login');
    }

    // Checks the submitted password against ADMIN_PASSWORD in .env.
    // Using === for strict comparison so types have to match too.
    public function loginPost(Request $request)
    {
        if ($request->password === env('ADMIN_PASSWORD')) {
            // Write a flag to the session so the middleware knows we're logged in
            session(['admin_authed' => true]);
            return redirect('/admin');
        }

        return back()->withErrors(['password' => 'Incorrect password']);
    }

    // Removes the admin session flag and sends back to the login page
    public function logout()
    {
        session()->forget('admin_authed');
        return redirect('/admin/login');
    }

    // Creates a new post from the form fields.
    // Str::slug() turns the title into a URL-safe filename, e.g.
    // "My First Post" becomes "my-first-post.md"
    public function upload(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:200',
            'date'         => 'required|string',
            'description'  => 'nullable|string|max:500',
            'body'         => 'required|string',
            'image_upload' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        $imageName = '';

        // If an image was uploaded, save it to public/images/posts/
        if ($request->hasFile('image_upload')) {
            $file = $request->file('image_upload');
            $imageName = $file->getClientOriginalName();
            $file->move(public_path('images/posts'), $imageName);
        }

        $slug = Str::slug($request->title);

        // Build the markdown file content with YAML front matter
        $content  = "---\n";
        $content .= "title: {$request->title}\n";
        $content .= "date: \"{$request->date}\"\n";
        $content .= "description: {$request->description}\n";
        $content .= "image: {$imageName}\n";
        $content .= "---\n\n";
        $content .= $request->body;

        File::put(base_path("content/posts/{$slug}.md"), $content);

        return redirect('/admin')->with('success', 'Post created: ' . $slug);
    }

    // Reads all message JSON files and passes them to the view sorted newest first
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

    // Loads an existing post's front matter and body into the edit form.
    // YamlFrontMatter splits the file so I can populate each field separately.
    public function edit(string $slug)
    {
        $path = base_path("content/posts/{$slug}.md");

        abort_unless(File::exists($path), 404);

        $document = YamlFrontMatter::parseFile($path);

        return view('admin-edit-post', [
            'slug'        => $slug,
            'title'       => $document->matter('title'),
            'date'        => $document->matter('date'),
            'description' => $document->matter('description', ''),
            'image'       => $document->matter('image', ''),
            'body'        => $document->body(),
        ]);
    }

    // Saves edits back to the .md file. If a new image is uploaded it takes
    // priority over whatever was already in the image field.
    public function update(Request $request, string $slug)
    {
        $request->validate([
            'title'        => 'required|string|max:200',
            'date'         => 'required|string',
            'description'  => 'nullable|string|max:500',
            'image'        => 'nullable|string|max:200',
            'body'         => 'required|string',
            'image_upload' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        // Default to the existing image field value
        $imageName = $request->image;

        if ($request->hasFile('image_upload')) {
            $file = $request->file('image_upload');
            $imageName = $file->getClientOriginalName();
            $file->move(public_path('images/posts'), $imageName);
        }

        $content  = "---\n";
        $content .= "title: {$request->title}\n";
        $content .= "date: \"{$request->date}\"\n";
        $content .= "description: {$request->description}\n";
        $content .= "image: {$imageName}\n";
        $content .= "---\n\n";
        $content .= $request->body;

        File::put(base_path("content/posts/{$slug}.md"), $content);

        return redirect("/admin/posts/{$slug}/edit")->with('success', 'Post updated.');
    }

    // Standalone image uploader -- saves to public/images/posts/
    // useful for uploading images to reference in post body content
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|file|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        $file = $request->file('image');
        $filename = $file->getClientOriginalName();

        $file->move(public_path('images/posts'), $filename);

        return redirect('/admin')->with('success', 'Image uploaded: ' . $filename);
    }
}
