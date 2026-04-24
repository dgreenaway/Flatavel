@extends('layout')

@section('title', '404 Not Found')
@section('page_num', '404')

@section('content')
<div class="tt-page-title-bar red">
    <h1 class="tt-page-title">404 Not Found</h1>
</div>
<div class="tt-content tt-404-wrap">
    <span class="tt-404-code">404</span>
    <p class="tt-404-msg">Page Not Found</p>
    <p class="tt-404-sub">The page you're looking for doesn't exist.</p>
    <a href="/posts" class="tt-btn tt-btn-cyan">Back to Posts</a>
</div>
@endsection