# Laravel Lite Blog

A simple file-based blog built with Laravel as a learning project. No database — posts are just Markdown files stored in `content/posts/`.

I'm using this to get familiar with how Laravel works: routing, controllers, models, views, and how it all fits together.

## What it does

- Lists all blog posts on the homepage
- Each post has its own page at `/posts/{slug}`
- Posts are written in Markdown with YAML front matter (title, date etc.)
- No database needed — the `Post` model reads straight from the filesystem

## Tech

- Laravel 13
- PHP 8.5
- [spatie/yaml-front-matter](https://github.com/spatie/yaml-front-matter) for parsing post metadata
- [league/commonmark](https://github.com/thephpleague/commonmark) for converting Markdown to HTML

## Running it locally

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```
