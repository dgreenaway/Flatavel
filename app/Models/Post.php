<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use League\CommonMark\CommonMarkConverter;

// This is my Post model. Unlike a normal Laravel model it doesn't extend
// Eloquent or touch a database at all. Instead it reads .md files directly
// from the content/posts directory. I'm using it to learn how models work
// without the complexity of a database setup.

class Post
{
    // I'm using PHP 8 constructor property promotion here. Each property
    // maps to a field in the YAML front matter of the markdown file.
    // image defaults to an empty string so I can check if one exists.
    public function __construct(
        public string $slug,
        public string $title,
        public string $date,
        public string $description,
        public string $body,
        public string $image = '',
    ) {}

    // Returns all posts sorted newest first.
    // collect() is a Laravel helper that lets me chain methods like
    // sortByDesc() and values() on a plain array, which is handy.
    public static function all(): array
    {
        $files = File::files(base_path('content/posts'));

        return collect($files)
            ->map(fn($file) => self::fromFile($file))
            ->sortByDesc('date')
            ->values()
            ->all();
    }

    // Finds a single post by its slug (the filename without .md).
    // abort_unless is a neat Laravel shortcut -- if the file doesn't
    // exist it throws a 404 automatically.
    public static function find(string $slug): self
    {
        $path = base_path("content/posts/{$slug}.md");

        abort_unless(File::exists($path), 404);

        return self::fromFile($path);
    }

    // Parses a single .md file into a Post object.
    // YamlFrontMatter splits the file into the front matter (the --- block)
    // and the body. CommonMark converts the body from Markdown to HTML.
    private static function fromFile(string $path): self
    {
        $document = YamlFrontMatter::parseFile($path);
        $converter = new CommonMarkConverter();

        return new self(
            slug: pathinfo($path, PATHINFO_FILENAME),
            title: $document->matter('title'),
            date: $document->matter('date'),
            description: $document->matter('description', ''),
            body: $converter->convert($document->body()),
            image: $document->matter('image', ''),
        );
    }
}
