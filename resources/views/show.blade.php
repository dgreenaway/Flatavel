@extends('layout')

@section('title', $post->title)

@section('content')
<div class="tt-page-title-bar yellow">
    <h1 class="tt-page-title">{{ $post->title }}</h1>
</div>
<div class="tt-content">
    <div class="tt-article-meta">{{ date('d M Y', $post->date) }}</div>
    <div class="tt-article-body">
        {!! $post->body !!}
    </div>
    <div class="tt-article-nav">
        <a class="prev" href="/posts">Back to all posts</a>
    </div>
</div>
@endsection
