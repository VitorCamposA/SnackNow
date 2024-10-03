<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>SnackNow - @yield('title')</title>
    <style>
        body{
            background-color: #212529;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg" style="background-color: #FFB703">
    <div class="container">
        <a class="navbar-brand text-dark" href="{{ route('home') }}">SnackNow | </a>
        <span class="nav-link text-secondary">{{Auth::user() ? Auth::user()->type_of == 2 ? "Client" : "Supplier" : 'Login or Register'}}</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown" data-bs-theme="dark">
            <ul class="navbar-nav ms-auto" style="background-color: #FFB703" aria-labelledby="dropdownMenuButtonDark">
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-dark {{ (request()->is('login')) ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark {{ (request()->is('register')) ? 'active' : '' }}" href="{{ route('register-client') }}">Register As Client</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark {{ (request()->is('register')) ? 'active' : '' }}" href="{{ route('register-supplier') }}">Register As Supplier</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" style="background-color: #FFB703">
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a class="dropdown-item text-dark" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                                <li class="nav-item">
                                    <a class="dropdown-item text-dark nav-link"
                                       href="{{Auth::user() && Auth::user()->type_of == 1 ?
                                        route('coupons.index') :
                                         route('coupon.show', 9)}}">My Coupons</a>
                                </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>


@yield('content')
@yield('js')

<footer class="py-4 bg-dark text-white text-center">
    <div class="container">
        <p>&copy; 2024 Snack Now. All Rights Reserved.</p>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.7/inputmask.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>
</html>
