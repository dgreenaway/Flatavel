@extends('layout')

@section('title', $post->title)
@section('page_num', 'P104')

@section('content')
@if ($post->image)
<div class="tt-post-hero">
    <img src="{{ asset('images/posts/' . $post->image) }}" alt="{{ $post->title }}">
    <div class="tt-post-hero-overlay">
        <div class="tt-post-hero-title">{{ $post->title }}</div>
        <div class="tt-post-hero-meta">{{ date('d M Y', strtotime($post->date)) }}</div>
    </div>
</div>
@else
<div class="tt-page-title-bar yellow">
    <h1 class="tt-page-title">{{ $post->title }}</h1>
    <span class="tt-article-meta">{{ date('d M Y', strtotime($post->date)) }}</span>
</div>
@endif

<div class="tt-content">
    <div class="tt-article-body">
        {!! $post->body !!}
    </div>
    <div class="tt-article-nav">
        <a class="prev" href="/posts">Back to all posts</a>
        @if (session('admin_authed'))
            <a href="/admin/posts/{{ $post->slug }}/edit" class="tt-btn tt-btn-yellow">Edit Post</a>
        @endif
    </div>
</div>
@endsection
