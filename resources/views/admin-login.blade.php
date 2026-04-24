@extends('layout')

@section('title', 'Admin Login')

@section('content')
<div class="tt-page-title-bar magenta">
    <h1 class="tt-page-title">Admin Login</h1>
</div>
<div class="tt-content">
    @if ($errors->any())
    <div class="tt-panel red">
        <div class="tt-panel-header">Error</div>
        <div class="tt-panel-body">{{ $errors->first('password') }}</div>
    </div>
    @endif

    <div class="tt-panel">
        <div class="tt-panel-header">Enter Password</div>
        <div class="tt-panel-body">
            <form action="/admin/login" method="POST">
                @csrf
                <div class="tt-form-group">
                    <label class="tt-form-label" for="password">Password</label>
                    <input class="tt-form-input" type="password" name="password" id="password">
                </div>
                <button class="tt-form-submit" type="submit">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection