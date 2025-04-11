<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Preload dark mode to prevent flash -->
    <script>
        // Immediately set dark mode before any content loads
        (function() {
            const theme = localStorage.getItem('theme') || 
                         (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', theme);
            
            // Add a class to prevent transition effects during page load
            document.documentElement.classList.add('no-transitions');
            
            // Add dark mode background to prevent white flash
            if (theme === 'dark') {
                document.documentElement.style.backgroundColor = '#1a1c23';
            }
            
            // Remove the no-transitions class after a small delay
            window.addEventListener('load', () => {
                setTimeout(() => {
                    document.documentElement.classList.remove('no-transitions');
                }, 100);
            });
        })();
    </script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MARRAKECH BUDGET TOURS - DASHBOARD</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/mbt-fav.png') }}?v=2">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        :root {
            --bg-primary: #f8f9fc;
            --bg-secondary: #ffffff;
            --text-primary: #2d3748;
            --text-secondary: #4a5568;
            --border-color: #e2e8f0;
            --hover-bg: #f7fafc;
            --shadow-color: rgba(0, 0, 0, 0.05);
            --nav-hover: rgba(0, 0, 0, 0.05);
            --table-stripe: #f9fafb;
            --card-bg: #ffffff;
            --input-bg: #ffffff;
            --input-border: #e2e8f0;
            --input-text: #2d3748;
            --input-placeholder: #a0aec0;
            --form-bg: #ffffff;
            --form-shadow: rgba(0, 0, 0, 0.1);
            --accent-color: #f9ab30;
            --accent-hover: #e69a1f;
            --accent-shadow: rgba(249, 171, 48, 0.25);
        }

        [data-theme="dark"] {
            --bg-primary: #1a1c23;
            --bg-secondary: #242631;
            --text-primary: #e2e8f0;
            --text-secondary: #a0aec0;
            --border-color: #2d303f;
            --hover-bg: #2d303f;
            --shadow-color: rgba(0, 0, 0, 0.2);
            --nav-hover: rgba(255, 255, 255, 0.1);
            --table-stripe: #1e2028;
            --card-bg: #242631;
            --input-bg: #2d3748;
            --input-border: #4a5568;
            --input-text: #e2e8f0;
            --input-placeholder: #718096;
            --form-bg: #1a1c23;
            --form-shadow: rgba(0, 0, 0, 0.3);
            --accent-color: #f9ab30;
            --accent-hover: #e69a1f;
            --accent-shadow: rgba(249, 171, 48, 0.25);
             
        }

        html {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        html.dark-mode {
            background-color: #1a1c23;
        }

        html.dark-mode body {
            visibility: hidden;
        }

        html.dark-mode.rendered body {
            visibility: visible;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            transition: background-color 0.3s ease;
            padding-top: 76px; /* Same as navbar height */
        }

        .navbar {
            background: var(--bg-secondary) !important;
            box-shadow: 0 2px 4px var(--shadow-color);
            padding: 0.75rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1050;
        }

        .main-content {
            margin-top: 76px; /* Adjust this value based on your navbar height */
            position: relative;
            z-index: 1;
        }

        /* Ensure dropdowns appear above other content */
        .navbar .dropdown-menu {
            z-index: 1051;
        }

        .navbar-nav .dropdown-menu {
            margin-top: 0.5rem;
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 0.5rem;
            display: none;
            position: absolute;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--text-primary) !important;
            margin-right: 2rem;
            letter-spacing: -0.5px;
        }

        .dropdown-menu {
            right: 0 !important;
            left: auto !important;
            min-width: 200px;
            border: none;
            box-shadow: 0 4px 6px var(--shadow-color);
            border-radius: 10px;
            margin-top: 0.75rem !important;
        }

        .dropdown-item {
            padding: 0.7rem 1.5rem;
            color: var(--text-secondary);
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
        }

        .dropdown-item:hover {
            background: var(--hover-bg);
            color: var(--text-primary);
        }

        .dropdown-item:active {
            background-color: #FF4500;
            color: white;
        }

        .nav-item.dropdown {
            position: relative;
        }

        #navbarDropdown {
            background: var(--bg-secondary);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            font-weight: 500;
        }

        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
        }

        /* Add padding to create hover space between button and menu */
        .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -10px;
            left: 0;
            right: 0;
            height: 10px;
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
            display: flex;
            align-items: center;
            white-space: nowrap;
        }

        #navbarDropdown:hover {
            background: var(--nav-hover);
            border-color: var(--text-secondary);
        }

        #navbarDropdown::after {
            margin-left: 0.5rem;
        }

        .dropdown-divider {
            margin: 0.5rem 0;
            border-top: 1px solid var(--border-color);
        }

        .sidebar {
            min-height: calc(100vh - 70px);
            background: var(--bg-secondary);
            box-shadow: 0 0 15px var(--shadow-color);
            border-radius: 15px;
            margin: 15px;
            padding: 15px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .sidebar .nav-link {
            color: var(--text-secondary);
            padding: 12px 20px;
            border-radius: 10px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background: var(--hover-bg);
            color: var(--text-primary);
        }

        .sidebar .nav-link.active {
            background: #4e73df;
            color: #fff;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .content-wrapper {
            background: var(--bg-secondary);
            border-radius: 15px;
            padding: 20px;
            margin: 15px;
            box-shadow: 0 0 15px var(--shadow-color);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        @media (max-width: 768px) {
            .navbar .container-fluid {
                padding-right: 1rem !important;
                padding-left: 1rem !important;
            }
            
            .navbar-nav .dropdown-menu {
                margin-top: 0;
                position: absolute !important;
                right: 0 !important;
                left: auto !important;
            }
            
            .sidebar, .content-wrapper {
                margin: 10px;
            }
        }

        .navbar-nav .dropdown-menu {
            margin-top: 0.5rem;
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 0.5rem;
        }
        .dropdown-item {
            padding: 0.5rem 1.5rem;
            display: flex;
            align-items: center;
        }
        .dropdown-item:active {
            background-color: #FF4500;
        }
        .nav-link {
            display: flex;
            align-items: center;
        }
        #navbarDropdown::after {
            margin-left: 0.5rem;
        }

        #darkModeToggle {
            color: var(--text-secondary);
            transition: color 0.3s ease;
        }

        #darkModeToggle:hover {
            color: var(--text-primary);
        }

        /* Improved navbar styles */
        .avatar-circle {
            border: 2px solid var(--border-color);
            transition: all 0.3s ease;
        }

        #navbarDropdown:hover .avatar-circle {
            border-color: var(--text-secondary);
        }

        /* Table styles for dark mode */
        .table {
            color: var(--text-primary);
        }

        .table thead th {
            border-bottom-color: var(--border-color);
            color: var(--text-secondary);
            font-weight: 600;
        }

        .table td, .table th {
            border-top-color: var(--border-color);
            padding: 1rem;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: var(--table-stripe);
        }

        /* Card styles for dark mode */
        .card {
            background-color: var(--card-bg);
            border-color: var(--border-color);
        }

        .card-header {
            background-color: var(--card-bg);
            border-bottom-color: var(--border-color);
            color: var(--text-primary);
        }

        /* Form styles for dark mode */
        .form-control {
            background-color: var(--input-bg) !important;
            border-color: var(--input-border) !important;
            color: var(--input-text) !important;
        }

        .form-control::placeholder {
            color: var(--input-placeholder) !important;
        }

        .form-select {
            background-color: var(--input-bg) !important;
            border-color: var(--input-border) !important;
            color: var(--input-text) !important;
        }

        /* Button improvements */
        .btn-primary {
            background-color: #FF4500;
            border-color: #FF4500;
        }

        .btn-primary:hover {
            background-color: #ff5722;
            border-color: #ff5722;
        }

        /* Dropdown menu improvements */
        .dropdown-menu {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px var(--shadow-color), 0 0 0 1px var(--border-color);
        }

        .dropdown-item {
            color: var(--text-primary);
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: var(--hover-bg);
            color: #FF4500;
        }

        .dropdown-divider {
            border-top: 1px solid var(--border-color);
        }

        /* Badge styles */
        .badge {
            padding: 0.5em 1em;
            font-weight: 500;
        }

        /* Form styles */
        .form-container {
            background: var(--bg-secondary) !important;
            border-radius: 15px;
            box-shadow: 0 4px 6px var(--shadow-color);
            border: 1px solid var(--border-color);
            padding: 2rem;
            margin-top: 1rem;
        }

        .form-control:focus {
            border-color: var(--accent-color) !important;
            box-shadow: 0 0 0 0.2rem var(--accent-shadow) !important;
        }

        /* Prevent flash of unstyled content */
        .no-transitions * {
            transition: none !important;
        }

        /* Smooth transitions after initial load */
        body {
            transition: background-color 0.3s ease, color 0.3s ease;
        }
    </style>

    @yield('css')

    <script>
        // Immediately set dark mode before page loads to prevent flash
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark-mode');
        }
    </script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container-fluid px-4">
                <a class="navbar-brand" href="{{ url('/admin/dashboard') }}">
                    MARRAKECH BUDGET TOURS - DASHBOARD
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav align-items-center">
                        <!-- Dark Mode Toggle -->
                        <li class="nav-item">
                            <button id="darkModeToggle" class="btn btn-link nav-link p-2" style="background: var(--bg-secondary); border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border: 1px solid var(--border-color); margin-right: 1rem;">
                                <i class="fas fa-sun" id="darkModeIcon" style="font-size: 1.2rem; color: var(--text-primary);"></i>
                            </button>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: var(--bg-secondary); border-radius: 50px; padding: 0.5rem 1rem; border: 1px solid var(--border-color);">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover;">
                                    @else
                                        <div class="avatar-circle" style="width: 35px; height: 35px; background-color: {{ '#' . substr(md5(Auth::user()->email), 0, 6) }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; text-transform: uppercase;">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <span class="ml-2 mr-1" style="font-weight: 600; color: var(--text-primary);">{{ Auth::user()->name }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right shadow-sm">
                                    @if(Auth::user()->is_admin)
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                                            <i class="fas fa-tachometer-alt mr-2"></i>{{ __('Dashboard') }}
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user-edit mr-2"></i>{{ __('Edit Profile') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('/') }}">
                                        <i class="fas fa-home mr-2"></i>{{ __('Home') }}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @auth
                <div class="container-fluid">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{session()->get('success')}}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{session()->get('error')}}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-3">
                            <div class="sidebar">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/') }}" style="background: #FF4500; color: #fff;">
                                            <i class="fas fa-home"></i>Back to Home
                                        </a>
                                    </li>

                                    @if(auth()->user()->is_admin)
                                        <li class="nav-item">
                                            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                                <i class="fas fa-tachometer-alt"></i>Dashboard
                                            </a>
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                                                <i class="fas fa-users"></i>Users
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link {{ Request::is('admin/destinations*') ? 'active' : '' }}" href="{{ route('destinations.index') }}">
                                                <i class="fas fa-map-marked-alt"></i>Destinations
                                            </a>
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a class="nav-link {{ Request::is('admin/categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                                                <i class="fas fa-folder"></i>Categories
                                            </a>
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a class="nav-link {{ Request::is('admin/tags*') ? 'active' : '' }}" href="{{ route('tags.index') }}">
                                                <i class="fas fa-tags"></i>Tags
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link {{ Request::is('admin/blog*') ? 'active' : '' }}" href="{{ route('blog.index') }}">
                                                <i class="fas fa-newspaper"></i>Blog Posts
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link {{ Request::is('admin/trashed-destinations*') ? 'active' : '' }}" href="{{ route('trashed-destinations.index') }}">
                                                <i class="fas fa-trash-alt"></i>Unavailable Destinations
                                            </a>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link {{ Request::is('profile*') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                                                <i class="fas fa-user-edit"></i>Edit Profile
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="content-wrapper">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @yield('content')
            @endauth
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')

    <!-- Dark mode implementation -->
    <script>
        // Function to get the current theme
        const getTheme = () => {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                return savedTheme;
            }
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        };

        // Function to set the theme
        const setTheme = (theme) => {
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
            updateDarkModeIcon(theme === 'dark');
        };

        // Function to update the icon
        function updateDarkModeIcon(isDark) {
            const icon = document.getElementById('darkModeIcon');
            if (icon) {
                icon.className = isDark ? 'fas fa-moon' : 'fas fa-sun';
            }
        }

        // Initial theme setup
        document.addEventListener('DOMContentLoaded', () => {
            setTheme(getTheme());
        });

        // Dark mode toggle functionality
        document.getElementById('darkModeToggle')?.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            setTheme(newTheme);
        });

        // Listen for system theme changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
            const newTheme = e.matches ? 'dark' : 'light';
            setTheme(newTheme);
        });
    </script>
</body>

</html>