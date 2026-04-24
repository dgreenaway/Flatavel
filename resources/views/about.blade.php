@extends('layout')

@section('title', 'About Me')
@section('page_num', 'P102')

@section('content')
<div class="tt-page-title-bar cyan">
    <h1 class="tt-page-title">About Me</h1>
    <span class="tt-page-badge">P102</span>
</div>
<div class="tt-content">
    <div class="tt-panel">
        <div class="tt-panel-header">Who Am I</div>
        <div class="tt-panel-body">
            <p>Hi, I'm Daniel Greenaway — a developer based in the UK. I build things for the web and occasionally write about it here.</p>
            <p>This blog is a learning project built with Laravel, using flat Markdown files instead of a database.</p>
        </div>
    </div>

    <div class="tt-panel">
        <div class="tt-panel-header">What I Work With</div>
        <div class="tt-panel-body">
            <div class="tt-skills-grid">
                <span class="tt-skill-tag">PHP</span>
                <span class="tt-skill-tag">Laravel</span>
                <span class="tt-skill-tag">JavaScript</span>
                <span class="tt-skill-tag">HTML & CSS</span>
                <span class="tt-skill-tag">Node.js</span>
                <span class="tt-skill-tag">Git</span>
            </div>
        </div>
    </div>

    <div class="tt-panel">
        <div class="tt-panel-header">Get In Touch</div>
        <div class="tt-panel-body">
            <p>Have a question or just want to say hello? <a href="/contact">Send me a message</a>.</p>
        </div>
    </div>
</div>
@endsection