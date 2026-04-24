@extends('layout')

@section('title', 'All Posts')

@section('content')
<h1>Posts</h1>

@foreach ($posts as $post)
<article>
    <h2>
        <a href="/posts/{{ $post->slug }}">
            {{ $post->title }}
        </a>
    </h2>
    <time>{{ $post->date }}</time>
    <p>{{ $post->description }}</p>
</article>
@endforeach
@endsection