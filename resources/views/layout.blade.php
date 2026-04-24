<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Daniel Greenaway')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {!! $settings['header_scripts'] ?? '' !!}
</head>

<body>
    <div class="crt-bezel">
        <div class="crt-screen-wrap">
            <div class="tt-screen">
                <header class="tt-header">
                    <div class="tt-header-inner">
                        <div class="tt-site-name">
                            <a href="/">{{ $settings['site_name'] ?? 'Flatavel' }}</a>
                        </div>
                        <div class="tt-header-right">
                            <span class="tt-page-num">@yield('page_num', 'P100')</span>
                            <span class="tt-channel">{{ $settings['site_tagline'] ?? 'Tagline' }}</span>
                            <span class="tt-clock" id="tt-clock"></span>
                        </div>
                    </div>
                </header>
                <div class="tt-color-bar">
                    <span class="tt-cb-white"></span>
                    <span class="tt-cb-yellow"></span>
                    <span class="tt-cb-cyan"></span>
                    <span class="tt-cb-green"></span>
                    <span class="tt-cb-magenta"></span>
                    <span class="tt-cb-red"></span>
                    <span class="tt-cb-blue"></span>
                </div>
                <nav class="tt-nav">
                    <ul>
                        <li><a href="/"><span class="tt-nav-num tt-nav-num-white">100</span>Home</a></li>
                        <li><a href="/posts"><span class="tt-nav-num tt-nav-num-yellow">101</span>Blog</a></li>
                        <li><a href="/about"><span class="tt-nav-num tt-nav-num-cyan">102</span>About</a></li>
                        <li><a href="/contact"><span class="tt-nav-num tt-nav-num-green">200</span>Contact</a></li>
                    </ul>
                </nav>
                <main class="tt-main">
                    <div class="tt-page">
                        @yield('content')
                    </div>
                </main>
                <footer class="tt-footer">
                    <div class="tt-footer-info">
                        <span>{{ $settings['footer_text'] ?? '© ' . date('Y') . ' Daniel Greenaway' }}</span>
                        <div style="display:flex; gap:12px; align-items:center;">
                            @if (session('admin_authed'))
                            <a href="/admin" class="tt-cyan">Upload</a>
                            <a href="/admin/messages" class="tt-cyan">Messages</a>
                            <a href="/admin/settings" class="tt-cyan">Settings</a>
                            <form action="/admin/logout" method="POST" style="display:inline">
                                @csrf
                                <button type="submit" class="tt-btn tt-btn-red">Logout</button>
                            </form>
                            @else
                            <a href="/admin/login" class="tt-cyan">Login</a>
                            @endif
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <script>
        const el = document.getElementById('tt-clock');
        const tick = () => el.textContent = new Date().toLocaleTimeString('en-GB');
        tick();
        setInterval(tick, 1000);
    </script>
</body>

</html>