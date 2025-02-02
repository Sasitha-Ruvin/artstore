<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Valyrian Vision') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="bg-[#f9f3eb]">
    <div id="app">
        <nav class="bg-[#f9f3eb] shadow-sm">
            <div class="container mx-auto flex justify-between items-center py-4">
                <!-- Logo Section -->
                <a class="flex items-center" href="{{ url('/') }}">
                    <img src="{{ asset('Images/logo.png') }}" alt="Logo" class="h-24 w-36"> 
                </a>

                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-8">
                    <a href="{{('/')}}" class="text-black hover:text-gray-700">Home</a>
                    <a href="{{ route('about') }}" class="text-black hover:text-gray-700">About</a>
                    <a href="#" class="text-black hover:text-gray-700">Contact</a>
                    <a href="{{url('/arts')}}" class="text-black hover:text-gray-700">Products</a>
                    <a href="{{ route('commission.form') }}" class="text-black hover:text-gray-700">Commission</a>
                    <a href="{{url('wish/wish')}}"class="text-black hover:text-gray-700" >Wishlist</a>
                    <a href="{{ route('cart.view') }}" class="text-black hover:text-gray-700">Cart</a>
                    

                </div>

                <!-- Authentication Links -->
                <div class="flex items-center space-x-4">
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="bg-[#5e4585] text-white px-4 py-2 rounded-full hover:bg-[#4d3a6f]">
                                Login
                            </a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-black text-white px-4 py-2 rounded-full hover:bg-gray-800">
                                Register
                            </a>
                        @endif
                    @else
                        <div class="relative">
                            <a id="navbarDropdown" class="text-black font-bold" href="#" role="button">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end absolute right-0 mt-2 bg-white rounded-lg shadow-lg">
                                <a class="dropdown-item px-4 py-2" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest

                    <!-- Cart Icon -->
                   
                </div>

                <!-- Hamburger Menu for Small Screens -->
                <button class="md:hidden text-black focus:outline-none" id="menu-toggle">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div class="hidden md:hidden" id="mobile-menu">
                <div class="px-4 pb-4 space-y-4">
                    <a href="#" class="block text-black hover:text-gray-700">Home</a>
                    <a href="#" class="block text-black hover:text-gray-700">About</a>
                    <a href="#" class="block text-black hover:text-gray-700">Contact</a>
                    <a href="#" class="block text-black hover:text-gray-700">Products</a>
                    <a href="#" class="block text-black hover:text-gray-700">Commission</a>

                    
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer class="bg-gray-800 text-gray-200 py-12">
    <div class="container mx-auto flex justify-between items-start">
        <!-- Company Info -->
        <div>
            <img src="{{ asset('Images/logo.png') }}" alt="Valyrian Visions" class="h-12 mb-4">
            <p>123/Main Street</p>
            <p>Main City</p>
            <p>0123-456-789</p>
            <p>example@mail.com</p>
        </div>

        <!-- Social Links -->
        <div class="space-x-4">
            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook"></i></a>
            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-whatsapp"></i></a>
        </div>

        <!-- Footer Links -->
        <div class="space-y-2">
            <a href="#" class="text-gray-400 hover:text-white">Home</a>
            <a href="#" class="text-gray-400 hover:text-white">About</a>
            <a href="#" class="text-gray-400 hover:text-white">Contact</a>
            <a href="#" class="text-gray-400 hover:text-white">Products</a>
            <a href="#" class="text-gray-400 hover:text-white">Commission</a>
        </div>
    </div>
</footer>

    </div>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
