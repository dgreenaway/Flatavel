@extends('layout')

@section('title', 'Settings')
@section('page_num', 'P902')

@section('content')
<div class="tt-page-title-bar magenta">
    <h1 class="tt-page-title">Settings</h1>
    <span class="tt-page-badge">P902</span>
</div>
<div class="tt-content">
    @if (session('success'))
    <div class="tt-panel cyan">
        <div class="tt-panel-header">Success</div>
        <div class="tt-panel-body">{{ session('success') }}</div>
    </div>
    @endif

    <div class="tt-panel">
        <div class="tt-panel-header">Site Settings</div>
        <div class="tt-panel-body">
            <form action="/admin/settings" method="POST">
                @csrf
                <div class="tt-form-group">
                    <label class="tt-form-label" for="site_name">Site Name</label>
                    <input class="tt-form-input" type="text" name="site_name" id="site_name"
                        value="{{ old('site_name', $settings['site_name'] ?? '') }}">
                    @error('site_name') <p class="tt-red">{{ $message }}</p> @enderror
                </div>
                <div class="tt-form-group">
                    <label class="tt-form-label" for="site_tagline">Tagline</label>
                    <input class="tt-form-input" type="text" name="site_tagline" id="site_tagline"
                        value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}">
                </div>
                <div class="tt-form-group">
                    <label class="tt-form-label" for="footer_text">Footer Text</label>
                    <input class="tt-form-input" type="text" name="footer_text" id="footer_text"
                        value="{{ old('footer_text', $settings['footer_text'] ?? '') }}">
                </div>
                <div class="tt-form-group">
                    <label class="tt-form-label" for="header_scripts">Header Scripts</label>
                    <textarea class="tt-form-textarea" name="header_scripts" id="header_scripts"
                        placeholder="Paste Google Analytics or other &lt;script&gt; tags here">{{ old('header_scripts', $settings['header_scripts'] ?? '') }}</textarea>
                </div>
                <button class="tt-form-submit" type="submit">Save Settings</button>
            </form>
        </div>
    </div>
</div>
@endsection