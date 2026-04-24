@extends('layout')

@section('title', 'Admin')
@section('page_num', 'P999')

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
        <div class="tt-panel-header">New Post</div>
        <div class="tt-panel-body">
            <form action="/admin/upload" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="tt-form-group">
                    <label class="tt-form-label" for="title">Title</label>
                    <input class="tt-form-input" type="text" name="title" id="title" value="{{ old('title') }}">
                    @error('title') <p class="tt-red">{{ $message }}</p> @enderror
                </div>
                <div class="tt-form-group">
                    <label class="tt-form-label" for="date">Date</label>
                    <input class="tt-form-input" type="text" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}">
                </div>
                <div class="tt-form-group">
                    <label class="tt-form-label" for="description">Description</label>
                    <input class="tt-form-input" type="text" name="description" id="description" value="{{ old('description') }}">
                </div>
                <div class="tt-form-group">
                    <label class="tt-form-label" for="body">Content</label>
                    <textarea class="tt-form-textarea" name="body" id="body" style="min-height:300px;">{{ old('body') }}</textarea>
                    @error('body') <p class="tt-red">{{ $message }}</p> @enderror
                </div>
                <div class="tt-form-group">
                    <label class="tt-form-label" for="image_upload">Featured Image (optional)</label>
                    <input class="tt-form-input" type="file" name="image_upload" id="image_upload" accept=".jpg,.jpeg,.png,.gif,.webp">
                </div>
                <button class="tt-form-submit" type="submit">Create Post</button>
            </form>
        </div>
    </div>


</div>
@endsection
