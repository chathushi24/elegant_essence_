@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto bg-white shadow-xl rounded-xl p-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <!-- Product Image -->
            <div class="relative">
                <img src="{{ asset('storage/'.$product->image) }}" 
                     class="w-full h-[450px] object-cover rounded-xl shadow-md border-4 border-pink-500">
                <div class="absolute top-4 left-4 bg-red-600 text-white text-sm font-semibold px-3 py-1 rounded-md shadow">
                    New Arrival
                </div>
            </div>
            
            <!-- Product Details -->
            <div>
                <h1 class="text-4xl font-extrabold text-black tracking-wide">{{ $product->name }}</h1>
                <p class="text-2xl text-red-600 font-semibold mt-2">LKR {{ number_format($product->price, 2) }}</p>
                <p class="text-gray-700 mt-4 leading-relaxed">{{ $product->description }}</p>
                <p class="text-gray-600 mt-2">Category: <strong class="text-black">{{ $product->category }}</strong></p>
                <p class="text-gray-600 mt-2">Available: <strong id="availableQuantity" class="text-red-600">{{ $product->quantity }}</strong></p>

                @auth
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-6">
                        @csrf

                        <!-- Size Selection -->
                        <label for="size" class="block text-gray-700 font-bold mb-1">Select a Size:</label>
                        <select name="size" id="size" required 
                                class="w-full p-3 border border-gray-400 rounded-lg focus:ring-red-500 focus:border-red-500">
                            <option value="" disabled selected>Select a size</option>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>

                        <!-- Quantity Selection -->
                        <div class="mt-4 flex items-center">
                            <label for="quantity" class="mr-2 font-bold text-gray-700">Quantity:</label>
                            <button type="button" id="decreaseQty" 
                                    class="px-4 py-2 bg-gray-300 text-black rounded-l-lg hover:bg-gray-400 transition">-</button>
                            <input type="number" id="quantity" name="quantity" min="1" max="{{ $product->quantity }}" value="1"
                                   class="w-16 text-center border border-gray-400 focus:ring-red-500 focus:border-red-500">
                            <button type="button" id="increaseQty" 
                                    class="px-4 py-2 bg-gray-300 text-black rounded-r-lg hover:bg-gray-400 transition">+</button>
                        </div>

                        <!-- Add to Cart Button -->
                        <button type="submit" 
                                class="mt-6 px-6 py-3 bg-gradient-to-r from-pink-500 to-red-600 text-white font-bold rounded-lg hover:from-red-500 hover:to-red-700 transition-all shadow-md">
                            Add to Cart
                        </button>
                    </form>
                @else
                    <p class="text-red-500 mt-4">
                        You must <a href="{{ route('login') }}" class="text-pink-600 font-bold hover:underline">login</a> to add items to the cart.
                    </p>
                @endauth
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const decreaseQty = document.getElementById('decreaseQty');
            const increaseQty = document.getElementById('increaseQty');
            const quantityInput = document.getElementById('quantity');
            const availableQuantity = parseInt(document.getElementById('availableQuantity').innerText);

            decreaseQty.addEventListener('click', function () {
                let currentVal = parseInt(quantityInput.value);
                if (currentVal > 1) {
                    quantityInput.value = currentVal - 1;
                }
            });

            increaseQty.addEventListener('click', function () {
                let currentVal = parseInt(quantityInput.value);
                if (currentVal < availableQuantity) {
                    quantityInput.value = currentVal + 1;
                }
            });
        });
    </script>
@endsection
