<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', config('app.name', 'SUMAN'))</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('styles')
    @stack('head-scripts')
</head>

<body>

    <section class="desktopNav">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Blog Management</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('blogs*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blogs</a>
                        </li>
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('myblog*') ? 'active' : '' }}" href="{{ url('/myblog') }}">My Blogs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="btn btn-danger ms-2" href="{{ route('logout') }}">Logout</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="{{ url('/login') }}">Log in</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('register') ? 'active' : '' }}" href="{{ url('/register') }}">Register</a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </section>
    

    @yield('content')
    @stack('scripts')
</body>

</html>
