<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Daniel Greenaway')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="crt-bezel">
        <div class="crt-screen-wrap">
            <div class="tt-screen">
                <header class="tt-header">
                    <div class="tt-header-inner">
                        <div class="tt-site-name">
                            <a href="/posts">DANIEL GREENAWAY</a>
                        </div>
                        <div class="tt-header-right">
                            <span class="tt-page-num">@yield('page_num', '100')</span>
                            <span class="tt-channel">BLOG</span>
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
                        <li><a href="/">Home</a></li>
                        <li><a href="/posts">Blog</a></li>
                        <li><a href="/about">About</a></li>
                        <li><a href="/contact">Contact</a></li>
                        @if (session('admin_authed'))
                        <li><a href="/admin">Update Blog</a></li>
                        <li><a href="/admin/messages">Messages</a></li>
                        @endif
                    </ul>
                </nav>
                <main class="tt-main">
                    <div class="tt-page">
                        @yield('content')
                    </div>
                </main>
                <footer class="tt-footer">
                    <div class="tt-footer-info">
                        <span>&copy; {{ date('Y') }} Daniel Greenaway</span>
                        @if (session('admin_authed'))
                        <form action="/admin/logout" method="POST" style="display:inline">
                            @csrf
                            <button type="submit" class="tt-btn tt-btn-red">Logout</button>
                        </form>
                        @else
                        <a href="/admin/login" class="tt-cyan">Login</a>
                        @endif
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