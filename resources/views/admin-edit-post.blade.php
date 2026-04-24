@extends('layout')

@section('title', 'Edit Post')
@section('page_num', 'P903')

@section('content')
<div class="tt-page-title-bar magenta">
    <h1 class="tt-page-title">Edit Post</h1>
    <span class="tt-page-badge">P903</span>
</div>
<div class="tt-content">
    @if (session('success'))
    <div class="tt-panel cyan">
        <div class="tt-panel-header">Success</div>
        <div class="tt-panel-body">{{ session('success') }}</div>
    </div>
    @endif

    <div class="tt-panel">
        <div class="tt-panel-header">{{ $slug }}</div>
        <div class="tt-panel-body">
            <form action="/admin/posts/{{ $slug }}/edit" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="tt-form-group">
                    <label class="tt-form-label" for="title">Title</label>
                    <input class="tt-form-input" type="text" name="title" id="title"
                        value="{{ old('title', $title) }}">
                    @error('title') <p class="tt-red">{{ $message }}</p> @enderror
                </div>
                <div class="tt-form-group">
                    <label class="tt-form-label" for="date">Date</label>
                    <input class="tt-form-input" type="text" name="date" id="date"
                        value="{{ old('date', $date) }}">
                </div>
                <div class="tt-form-group">
                    <label class="tt-form-label" for="description">Description</label>
                    <input class="tt-form-input" type="text" name="description" id="description"
                        value="{{ old('description', $description) }}">
                </div>
                <div class="tt-form-group">
                    @if ($image)
                    <label class="tt-form-label">Current Image</label>
                    <p style="color: var(--tt-cyan);">{{ old('image', $image) }}</p>
                    <input type="hidden" name="image" value="{{ old('image', $image) }}">
                    @else
                    <input type="hidden" name="image" value="">
                    @endif
                    <label class="tt-form-label" for="image_upload">{{ $image ? 'Replace Image' : 'Upload Image' }}</label>
                    <input class="tt-form-input" type="file" name="image_upload" id="image_upload"
                        accept=".jpg,.jpeg,.png,.gif,.webp">
                    <small style="color:#777;">Uploading a new image will replace the current one.</small>
                </div>

                <div class="tt-form-group">
                    <label class="tt-form-label" for="body">Content</label>
                    <textarea class="tt-form-textarea" name="body" id="body"
                        style="min-height: 300px;">{{ old('body', $body) }}</textarea>
                    @error('body') <p class="tt-red">{{ $message }}</p> @enderror
                </div>
                <div style="display:flex; gap:12px;">
                    <button class="tt-form-submit" type="submit">Save</button>
                    <a href="/posts/{{ $slug }}" class="tt-btn tt-btn-cyan">View Post</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection