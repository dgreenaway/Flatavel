@extends('layout')

@section('title', 'Daniel Greenaway')
@section('page_num', 'P100')

@section('content')
<div class="tt-home-hero">
    <span class="tt-home-hero-name">Daniel Greenaway<span class="tt-home-hero-cursor"></span></span>
    <span class="tt-home-hero-role">Web Person of a Particular Age</span>
    <div class="tt-ticker-bar">
        <span class="tt-ticker-label">LATEST:</span>
        Writing about Laravel, PHP, and building things for the web.
    </div>

    <div class="tt-content">
        <div class="tt-section-marker">Latest Posts</div>

        <ul class="tt-post-list">
            @foreach ($posts as $i => $post)
            <li class="tt-post-item">
                <span class="tt-post-num">{{ str_pad($i + 1, 3, '0', STR_PAD_LEFT) }}</span>
                <div class="tt-post-body">
                    <a class="tt-post-title-link" href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
                    <div class="tt-post-meta">{{ date('d M Y', $post->date) }}</div>
                    <div class="tt-post-excerpt">{{ $post->description }}</div>
                </div>
            </li>
            @endforeach
        </ul>

        <a href="/posts" class="tt-btn tt-btn-cyan">View All Posts</a>

        <div class="tt-section-marker" style="margin-top: 24px">About Me</div>
        <div class="tt-panel">
            <div class="tt-panel-body">
                <p>Developer based in the UK, building things for the web. <a href="/about">Read more →</a></p>
            </div>
        </div>
    </div>
    @endsection