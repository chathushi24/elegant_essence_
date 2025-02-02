@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section id="hero" class="relative h-screen text-white bg-cover bg-center top-0 z-50 overflow-y-scroll mt-0" style="background-image: url('/storage/images/freestocks-_3Q3tsJ01nc-unsplash.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div> 
    <div class="relative z-10 flex flex-col items-center justify-center h-full px-4 text-center">
        <h4 class="text-lg mb-2">Welcome to the store</h4>
        <h2 class="text-4xl mb-2">Embrace yourself with</h2>
        <h1 class="text-6xl font-bold mb-4">ELEGANT ESSENCE</h1>
    </div>
</section>

<!-- Recent Products Section -->
<section class="max-w-7xl mx-auto py-16 px-6">
    <h2 class="text-4xl font-extrabold text-center mb-8 text-gray-900 tracking-wide">
        ✨ Recent Products ✨
    </h2>

    @if ($recentProducts->isEmpty())
        <p class="text-gray-600 text-center">No recent products available.</p>
    @else
        <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-8">
            @foreach ($recentProducts as $product)
                <div class="bg-white p-6 rounded-2xl shadow-lg transition transform hover:scale-105 hover:shadow-2xl">
                    <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-52 object-cover mb-4 rounded-xl">
                    
                    <h3 class="text-2xl font-semibold mb-2 text-gray-900">{{ $product->name }}</h3>
                    <p class="text-gray-500 mb-2">{{ Str::limit($product->description, 80) }}</p>

                    <div class="flex items-center justify-between mt-4">
                        <span class="text-lg font-bold text-green-600">LKR {{ number_format($product->price, 2) }}</span>
                        <a href="{{ route('products.show', $product->_id) }}" class="text-white bg-gradient-to-r from-pink-500 to-pink-700 px-4 py-2 rounded-lg hover:from-red-600 hover:to-red-800 transition-all">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>

@endsection
