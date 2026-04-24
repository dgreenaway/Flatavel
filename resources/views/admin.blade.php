@extends('layout')

@section('title', 'Admin')
@section('page_num', '999')


@section('content')
<div class="tt-page-title-bar magenta">
    <h1 class="tt-page-title">Admin</h1>
    <span class="tt-page-badge">P999</span>
</div>
<div class="tt-content">
    @if (session('success'))
    <div class="tt-panel cyan">
        <div class="tt-panel-header">Success</div>
        <div class="tt-panel-body">{{ session('success') }}</div>
    </div>
    @endif

    @if ($errors->any())
    <div class="tt-panel red">
        <div class="tt-panel-header">Error</div>
        <div class="tt-panel-body">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <div class="tt-panel">
        <div class="tt-panel-header">Upload Post</div>
        <div class="tt-panel-body">
            <form action="/admin/upload" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="tt-form-group">
                    <label class="tt-form-label" for="file">Markdown File (.md)</label>
                    <input class="tt-form-input" type="file" name="file" id="file" accept=".md">
                </div>
                <button class="tt-form-submit" type="submit">Upload</button>
            </form>
        </div>
    </div>
</div>
@endsection