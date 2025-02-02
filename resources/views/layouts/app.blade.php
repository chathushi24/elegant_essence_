<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />
        @include('layouts.header')
        <div class="min-h-screen bg-gray-100">
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>

        </div>

        @stack('modals')

        @livewireScripts
    </body>
    <footer id="footer" class="section-p1 bg-pink-100 text-black py-8">
    <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- First Column -->
        <div class="col">
            <!-- <img class="logo w-20 h-20 mb-4" src="/images/logo1.jpeg" alt="logo"> -->
            <h4 class="text-lg font-bold mb-2">Contact</h4>
            <p><strong>Address: </strong> 613 Park Street, Union Place</p>
            <p><strong>Phone:</strong> +94 0112918753</p>
            <p><strong>Hours:</strong> 09:00 - 18:00, Mon - Sat</p>

            <div class="follow mt-4">
                <h4 class="text-lg font-bold mb-2">Follow Us</h4>
                <div class="flex space-x-4 text-xl">
                    <i class="fab fa-facebook-f cursor-pointer hover:text-blue-500"></i>
                    <i class="fab fa-twitter cursor-pointer hover:text-blue-400"></i>
                    <i class="fab fa-instagram cursor-pointer hover:text-pink-500"></i>
                    <i class="fab fa-pinterest cursor-pointer hover:text-red-500"></i>
                    <i class="fab fa-youtube cursor-pointer hover:text-red-600"></i>
                </div>
            </div>
        </div>

        <!-- Second Column -->
        <div class="col">
            <h4 class="text-lg font-bold mb-2">About</h4>
            <ul class="space-y-2">
                <li><a href="#" class="hover:underline">About us</a></li>
                <li><a href="#" class="hover:underline">Delivery Information</a></li>
                <li><a href="#" class="hover:underline">Privacy Policy</a></li>
                <li><a href="#" class="hover:underline">Terms and Conditions</a></li>
                <li><a href="#" class="hover:underline">Contact Us</a></li>
            </ul>
        </div>

        <!-- Third Column -->
        <div class="col">
            <h4 class="text-lg font-bold mb-2">My Account</h4>
            <ul class="space-y-2">
                <li><a href="#" class="hover:underline">Sign in</a></li>
                <li><a href="#" class="hover:underline">View cart</a></li>
                <li><a href="#" class="hover:underline">My wishlist</a></li>
                <li><a href="#" class="hover:underline">Track my order</a></li>
                <li><a href="#" class="hover:underline">Help</a></li>
            </ul>
        </div>

        <!-- Copyright Section -->
        <div class="col">
            <p class="text-sm text-center lg:text-left mt-4 lg:mt-0">
                © 2021, Tech2 YTD - HTML CSS Ecommerce Website
            </p>
        </div>
    </div>
</footer>

</html>