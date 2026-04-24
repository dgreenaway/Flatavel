@extends('layout')

@section('title', 'Contact')
@section('page_num', '103')

@section('content')
<div class="tt-page-title-bar green">
    <h1 class="tt-page-title">Contact</h1>
    <span class="tt-page-badge">P200</span>
</div>
<div class="tt-content">
    @if (session('success'))
    <div class="tt-panel cyan">
        <div class="tt-panel-header">Success</div>
        <div class="tt-panel-body">{{ session('success') }}</div>
    </div>
    @endif

    <div class="tt-panel">
        <div class="tt-panel-header">Send a Message</div>
        <div class="tt-panel-body">
            <form action="/contact" method="POST">
                @csrf
                <div class="tt-form-group">
                    <label class="tt-form-label" for="name">Name</label>
                    <input class="tt-form-input" type="text" name="name" id="name" value="{{ old('name') }}">
                    @error('name') <p class="tt-red">{{ $message }}</p> @enderror
                </div>
                <div class="tt-form-group">
                    <label class="tt-form-label" for="email">Email</label>
                    <input class="tt-form-input" type="email" name="email" id="email" value="{{ old('email') }}">
                    @error('email') <p class="tt-red">{{ $message }}</p> @enderror
                </div>
                <div class="tt-form-group">
                    <label class="tt-form-label" for="message">Message</label>
                    <textarea class="tt-form-textarea" name="message" id="message">{{ old('message') }}</textarea>
                    @error('message') <p class="tt-red">{{ $message }}</p> @enderror
                </div>
                <button class="tt-form-submit" type="submit">Send</button>
            </form>
        </div>
    </div>
</div>
@endsection