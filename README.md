# Laravel Lite Blog

A simple file-based blog built with Laravel as a learning project. No database — posts are just Markdown files stored in `content/posts/`.

I'm using this to get familiar with how Laravel works: routing, controllers, models, views, middleware, and how it all fits together.

## What it does

- Lists all blog posts on the homepage
- Each post has its own page at `/posts/{slug}`
- Posts are written in Markdown with YAML front matter (title, date etc.)
- No database needed — the `Post` model reads straight from the filesystem
- Password-protected admin section for uploading new posts

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

Posts go in `content/posts/` as `.md` files with YAML front matter:

```yaml
---
title: My Post Title
date: "2024-03-15"
description: A short summary of the post.
---

Post content here in Markdown.
```

## Admin

Visit `/admin` to upload new posts. You'll be prompted for a password — set it in `.env`:

```
ADMIN_PASSWORD=yourpasswordhere
```

## Notes to self

- `bootstrap/cache/` files are auto-generated, don't commit them
- `.env` holds local config, never commit it
- Sessions use the file driver — no database needed
