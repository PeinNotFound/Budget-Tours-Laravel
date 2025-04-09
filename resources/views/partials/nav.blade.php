<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo/mbt-logo.png') }}" alt="Marrakech Budget Tours">
        </a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a href="{{ url('/') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
                    <a href="{{ route('about') }}" class="nav-link">About</a>
                </li>
                <li class="nav-item {{ Request::is('packages*') ? 'active' : '' }}">
                    <a href="{{ route('packages') }}" class="nav-link">Destinations</a>
                </li>
                <li class="nav-item {{ Request::is('blog*') ? 'active' : '' }}">
                    <a href="{{ route('blog') }}" class="nav-link">Blog</a>
                </li>
                <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
                    <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                </li>
                @if(Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->is_admin)
                                <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->

<style>
/* Common styles for all screen sizes */
#ftco-navbar {
    background: none !important;
    position: fixed;
    width: 100%;
    z-index: 1030;
    transition: all 0.3s ease;
    padding: 15px 0;
}

#ftco-navbar .container {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: none !important;
}

.navbar-brand {
    padding: 0 !important;
    margin: 0;
    display: flex;
    align-items: center;
    background: none !important;
    transition: all 0.3s ease;
}

.navbar-brand img {
    height: 90px;
    width: auto;
    transition: height 0.3s ease;
}

.navbar-toggler {
    padding: 0.5rem;
    font-size: 1.25rem;
    line-height: 1;
    background-color: transparent;
    border: 2px solid orangered !important;
    border-radius: 4px;
    color: orangered !important;
    cursor: pointer;
    outline: none !important;
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 69, 0, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
}

.nav-link {
    color: orangered !important;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
    padding: 0.5rem 1rem !important;
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 2px;
    background-color: orangered;
    transition: width 0.3s ease;
}

.nav-link:hover::after,
.nav-item.active .nav-link::after {
    width: 80%;
}

.nav-item.active .nav-link {
    color: #ff4500 !important;
}

/* Desktop styles (lg and up) */
@media (min-width: 992px) {
    .navbar-brand img {
        height: 90px;
    }
    
    .dropdown-menu {
        background: rgba(255, 255, 255, 0.95) !important;
        border: none !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
    }
    
    .dropdown-item {
        padding: 0.5rem 1.5rem !important;
    }
}

/* Tablet and mobile styles */
@media (max-width: 991.98px) {
    .navbar-brand img {
        height: 60px;
    }
    
    .navbar-collapse {
        background: rgba(0, 0, 0, 0.95) !important;
        padding: 15px;
        margin-top: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: absolute;
        top: 100%;
        left: 15px;
        right: 15px;
        z-index: 1000;
    }
    
    .nav-item {
        padding: 8px 0;
    }
    
    .nav-link {
        color: #fff !important;
        padding: 0.5rem 0 !important;
        display: block;
    }
    
    .dropdown-menu {
        background: transparent !important;
        border: none !important;
        padding-left: 15px;
    }
    
    .dropdown-item {
        color: #fff !important;
        padding: 0.5rem 0 !important;
    }

    .navbar-toggler {
        z-index: 1001;
    }
}

/* Small mobile devices */
@media (max-width: 575.98px) {
    .navbar-brand img {
        height: 50px;
    }
    
    #ftco-navbar {
        padding: 10px 0;
    }
}

/* Scrolled state styles */
#ftco-navbar.scrolled {
    background: rgba(0, 0, 0, 0.9) !important;
    padding: 10px 0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

#ftco-navbar.scrolled .navbar-brand img {
    height: 60px;
}

#ftco-navbar.scrolled .nav-link {
    color: #fff !important;
}

#ftco-navbar.scrolled .nav-link:hover,
#ftco-navbar.scrolled .nav-link.active {
    color: orangered !important;
}

#ftco-navbar.scrolled .navbar-toggler {
    border-color: #fff !important;
}

/* Mobile scrolled state */
@media (max-width: 991.98px) {
    #ftco-navbar.scrolled .navbar-collapse {
        background: rgba(0, 0, 0, 0.95) !important;
    }
    
    #ftco-navbar.scrolled .navbar-brand img {
        height: 50px;
    }
}
</style>

<!-- Required Bootstrap and jQuery scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle navbar scroll behavior
    function updateNavbar() {
        const navbar = document.getElementById('ftco-navbar');
        if (window.scrollY > 150) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
        
        // Adjust logo size based on scroll and screen size
        const logo = document.querySelector('.navbar-brand img');
        if (window.innerWidth >= 992) {
            logo.style.height = navbar.classList.contains('scrolled') ? '70px' : '90px';
        } else if (window.innerWidth >= 576) {
            logo.style.height = navbar.classList.contains('scrolled') ? '50px' : '60px';
        } else {
            logo.style.height = navbar.classList.contains('scrolled') ? '40px' : '50px';
        }
    }
    
    window.addEventListener('scroll', updateNavbar);
    window.addEventListener('resize', updateNavbar);
    updateNavbar(); // Initialize
    
    // Better mobile menu handling
    $('.navbar-toggler').on('click', function() {
        $('.navbar-collapse').toggleClass('show');
    });
    
    // Close mobile menu when clicking a link
    $('.navbar-nav .nav-link').on('click', function() {
        $('.navbar-collapse').removeClass('show');
    });

    // Close mobile menu when clicking outside
    $(document).on('click', function(event) {
        const $navbar = $('.navbar');
        const $navbarToggler = $('.navbar-toggler');
        if (!$(event.target).closest($navbar).length && !$(event.target).is($navbarToggler)) {
            $('.navbar-collapse').removeClass('show');
        }
    });
});
</script>

<!-- Add viewport meta tag with content-width=device-width -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 