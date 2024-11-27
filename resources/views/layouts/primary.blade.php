<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>SnackNow - @yield('title')</title>
    <style>
        body{
            background-color: #212529;
            width: 100vw;
            min-height: 100vh;
            overflow-x: hidden;
        }
            nav{
                position: sticky;
                top: 0px;
                z-index: 1;

                display: flex;
                align-items: center;
                justify-content: space-between;

                padding: 10px 50px;

                background-color: #ffb703;
            }

            nav h1 a{
                text-decoration: none;
                color: #212529;
            }

            nav h1{
                color: #212529;
                font-size: 15pt;
            }

            nav .content-links{
                display: flex;
                gap: 20px;
            }

            nav .content-links a{
                color: #212529;
                font-size: 11pt;
                font-weight: 500;
                text-decoration: none;
            }
    </style>
</head>
<body>
<nav>
    <h1> <a href="{{ route('home') }}">SnackNow</a></h1>
    <div class="content-links">
        @guest
            <a href="{{ route('login') }}" class="{{ request()->is('login') ? 'active' : '' }}">Login</a>
            <a href="{{ route('register-client') }}" class="{{ request()->is('register-client') ? 'active' : '' }}">Registrar como Cliente</a>
            <a href="{{ route('register-supplier') }}" class="{{ request()->is('register-supplier') ? 'active' : '' }}">Registrar como Parceiro</a>
        @else
            <a href="{{ Auth::user()->type_of == 1 ? route('coupons.index') : route('coupon.show', 9) }}" class="dropdown-item">
                @if(Auth::user()->type_of ==1)
                    Gerenciar Cupons
                @else
                    Meus Cupons
                @endif
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="userDropdown">
                    <a href="{{ route('logout') }}" class="dropdown-item"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            </div>
        @endguest
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
