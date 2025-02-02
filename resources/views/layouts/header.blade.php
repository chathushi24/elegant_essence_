<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <header class="bg-pink-100  py-4 shadow-md">
        <div class="container mx-auto flex items-center justify-between px-6">
            <!-- Left: Logo -->
            <div class="flex items-center">
                <img src="{{ asset('/storage/images/L.png') }}" alt="Elegant Essence Logo" class="h-10">
            </div>

            <!-- Center: Navigation -->
            <nav class="flex-1 flex justify-center space-x-6">
                <a href="/" class="px-4 py-2 bg-pink-600 text-white font-semibold rounded-md shadow-md hover:bg-pink-700 transition">Home</a>
                <a href="/products" class="px-4 py-2 bg-pink-600 text-white font-semibold rounded-md shadow-md hover:bg-pink-700 transition">Shop</a>
                <a href="/contact" class="px-4 py-2 bg-pink-600 text-white font-semibold rounded-md shadow-md hover:bg-pink-700 transition">Contact Us</a>
            </nav>

            <!-- Right: Cart & Profile -->
            <div class="flex items-center space-x-6">
                <!-- Cart Icon -->
                <div class="relative">
                    <a href="/cart" class="relative text-black hover:text-pink-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l1 5m0 0h13l1-5H5m1 5l1 9h10l1-9M9 18h0.01M15 18h0.01" />
                        </svg>
                        @if(session('cart'))
                            <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>
                </div>

                <!-- Profile Dropdown-->
                @auth 
                     <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-pink-400 transition">
                                    <img class="size-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-black bg-white hover:text-pink-600 focus:outline-none focus:bg-pink-200 transition">
                                        {{ Auth::user()->name }}
                                        <svg class="ms-2 -me-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot> 

                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link> 

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-black font-medium hover:text-pink-600 transition">Login</a>
                @endauth
            </div>
        </div>
    </header>
</body>
</html>
