@extends('layout')

@section('title', 'All Posts')

@section('content')
<div class="tt-page-title-bar">
    <h1 class="tt-page-title">All Posts</h1>
    <span class="tt-page-badge">P100</span>
</div>
<div class="tt-content">
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
</div>
@endsection
