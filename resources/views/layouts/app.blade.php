<?php
    session_start();
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite('resources/js/filter.js')
    @vite('resources/js/orders.js')
    @vite('resources/js/cart.js')
    @vite('resources/js/sendCost.js')
    @vite('resources/css/order.css')

    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
                {{-- als er een gebruiker is ingelogd --}}
                @auth
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item bg-white">
                            <a class="nav-link" href="{{ route('history') }}">History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('order') }}">Bestellen</a>
                        </li>
                        
                    </ul>
        
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart') }}">&#128722;<span class="badge bg-secondary" id="cartCount"></span></a>
                            
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
        
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
        
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.show', ['user' => Auth::user()->id ]) }}"
                                        onclick="event.preventDefault();
                                                      document.getElementById('profile-form').submit();">
                                         {{ __('Profile') }}
                                    </a>
                                    
                                    {{-- alleen ald de gebu-ruiker de rol admin heeft --}}
                                    @if (Auth::user()->role->name == 'admin')
                                    <a class="dropdown-item" href="{{ route('adminPage') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('admin-form').submit();">
                                     {{ __('Admin pagina') }}
                                    </a>
                                        
                                    @endif
        
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                         {{ __('Logout') }}
                                    </a>
        
                                    <form id="profile-form" action="{{ route('profile.show', ['user' => Auth::user()->id ]) }}" method="GET" class="d-none">
                                        @csrf
                                    </form>

                                    <form id="admin-form" action="{{ route('adminPage') }}" method="GET" class="d-none">
                                        @csrf
                                    </form>
        
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
                @endauth
            </div>
        </nav>
        

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>
