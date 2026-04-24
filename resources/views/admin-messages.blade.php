@extends('layout')

@section('title', 'Messages')
@section('page_num', 'P998')


@section('content')
<div class="tt-page-title-bar magenta">
    <h1 class="tt-page-title">Messages</h1>
    <span class="tt-page-badge">P998</span>
</div>
<div class="tt-content">
    @if (empty($messages))
    <p>No messages yet.</p>
    @else
    @foreach ($messages as $message)
    <div class="tt-panel">
        <div class="tt-panel-header">
            {{ $message['name'] }} &mdash; {{ $message['date'] }}
        </div>
        <div class="tt-panel-body">
            <p><span class="tt-cyan">From:</span> {{ $message['email'] }}</p>
            <p>{{ $message['message'] }}</p>
        </div>
    </div>
    @endforeach
    @endif
</div>
@endsection