<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use League\CommonMark\CommonMarkConverter;

class Post
{
    public function __construct(
        public string $slug,
        public string $title,
        public string $date,
        public string $description,
        public string $body,
    ) {}

    // Get ALL posts, newest first
    public static function all(): array
    {
        $files = File::files(base_path('content/posts'));

        return collect($files)
            ->map(fn($file) => self::fromFile($file))
            ->sortByDesc('date')
            ->values()
            ->all();
    }

    // Get ONE post by its slug (filename)
    public static function find(string $slug): self
    {
        $path = base_path("content/posts/{$slug}.md");

        abort_unless(File::exists($path), 404);

        return self::fromFile($path);
    }

    // Parse a single file into a Post object
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
        );
    }
}
