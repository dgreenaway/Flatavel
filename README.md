# Laravel Lite Blog

A simple file-based blog built with Laravel as a learning project. No database — posts are just Markdown files stored in `content/posts/`.

I'm using this to get familiar with how Laravel works: routing, controllers, models, views, middleware, and how it all fits together.

## Pages

- `/` — Homepage with hero intro and latest 3 posts
- `/posts` — Full blog post list
- `/posts/{slug}` — Single post
- `/about` — About me
- `/contact` — Contact form (messages saved as JSON files)
- `/admin` — Password-protected admin area (upload posts, view messages)

## Tech

- Laravel 13
- PHP 8.5
- [spatie/yaml-front-matter](https://github.com/spatie/yaml-front-matter) for parsing post metadata
- [league/commonmark](https://github.com/thephpleague/commonmark) for converting Markdown to HTML
- Ceefax-inspired teletext theme with CRT effects

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

Visit `/admin` to upload new posts and view contact messages. You'll be prompted for a password — set it in `.env`:

```
ADMIN_PASSWORD=yourpasswordhere
```

## Notes to self

- `bootstrap/cache/` files are auto-generated, don't commit them
- `.env` holds local config, never commit it
- Sessions use the file driver — no database needed
- Contact messages are saved as JSON files in `content/messages/`
