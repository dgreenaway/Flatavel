@extends('layout')

@section('title', 'Daniel Greenaway')
@section('page_num', 'P100')

@section('content')
<div class="tt-home-hero">
    <span class="tt-home-hero-name">Daniel Greenaway<span class="tt-home-hero-cursor"></span></span>
    <span class="tt-home-hero-role">Digital Marketing Specialist, Web Developer & Ongoing Project With No Clear Deadline.</span>
</div>

<div class="tt-ticker-bar">
    <span class="tt-ticker-label">LATEST:</span>
    Writing about Laravel, PHP, and building things for the web.
</div>

<div class="tt-content">
    <div class="tt-section-marker">Latest Posts</div>

    <div class="tt-grid-3">
        @foreach ($posts as $post)
        <a href="/posts/{{ $post->slug }}" class="tt-home-post-card">
            @if ($post->image)
            <div class="tt-home-post-card-img">
                <img src="{{ asset('images/posts/' . $post->image) }}" alt="{{ $post->title }}">
            </div>
            @else
            <div class="tt-home-post-card-img tt-home-post-card-no-img">
                <span>///</span>
            </div>
            @endif
            <div class="tt-home-post-card-body">
                <span class="tt-home-post-card-title">{{ $post->title }}</span>
                <span class="tt-home-post-card-meta">{{ date('d M Y', strtotime($post->date)) }}</span>
                <span class="tt-home-post-card-excerpt">{{ $post->description }}</span>
            </div>
        </a>
        @endforeach
    </div>

    <a href="/posts" class="tt-btn tt-btn-cyan" style="margin-top: 8px; display: inline-block;">View All Posts</a>

    <div class="tt-grid-2" style="margin-top: 24px;">
        <div class="tt-panel">
            <div class="tt-panel-header">About Me</div>
            <div class="tt-panel-body">
                <p>Developer based in the UK, building things for the web.</p>
                <a href="/about" class="tt-btn tt-btn-blue" style="margin-top: 8px; display: inline-block;">Read More</a>
            </div>
        </div>
        <div class="tt-panel">
            <div class="tt-panel-header">Get In Touch</div>
            <div class="tt-panel-body">
                <p>Have a question or just want to say hello?</p>
                <a href="/contact" class="tt-btn tt-btn-green" style="margin-top: 8px; display: inline-block;">Contact Me</a>
            </div>
        </div>
    </div>
</div>
@endsection