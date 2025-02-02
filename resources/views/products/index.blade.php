@extends('layouts.app')

@section('content')

    <!-- Hero Video Section -->
    <section id="head-video">
        <video autoplay muted loop class="w-full h-[550px] object-cover m-0 p-0 mt-0" src="{{ asset('storage/images/7871229-hd_2048_1080_25fps.mp4') }}" type="video/mp4"></video>
    </section>

    <!-- Title Section -->
    <section id="product1" class="py-10 px-20 text-center">
        <h2 class="text-4xl font-semibold mb-2 text-gray-900">Shop for your own happiness</h2>
        <p class="text-lg text-gray-600">Summer Collection 2025 With New Designs</p>
    </section>

    <!-- Product Grid -->
    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Available Products</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach($products as $product)
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
    </div>

@endsection
