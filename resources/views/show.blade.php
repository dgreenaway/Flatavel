@extends('layout')

@section('title', $post->title)

@section('content')
<article>
    <header>
        <h1>{{ $post->title }}</h1>
        <time><time>{{ date('d M Y', $post->date) }}</time>
    </header>

    <div class="prose">
        {!! $post->body !!}
    </div>
</article>

<a href="/posts">← Back to all posts</a>
@endsection