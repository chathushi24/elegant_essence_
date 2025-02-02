@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-12">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 border-b pb-4">🛒 Your Cart</h1>

        @if($cartItems && $cartItems->count() > 0)
            <table class="w-full border border-gray-200 rounded-lg overflow-hidden shadow-md">
                <thead class="bg-gray-100 text-gray-800">
                    <tr class="text-left">
                        <th class="p-4">Product</th>
                        <th class="p-4">Price</th>
                        <th class="p-4">Quantity</th>
                        <th class="p-4">Total</th>
                        <th class="p-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php $total = 0; @endphp
                    @foreach($cartItems as $cartItem)
                        @php 
                            $subtotal = $cartItem->product->price * $cartItem->quantity;
                            $total += $subtotal;
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 flex items-center space-x-4">
                                <img src="{{ asset('storage/' . $cartItem->product->image) }}" 
                                     onerror="this.onerror=null;this.src='{{ asset('storage/images/default.png') }}';"
                                     alt="{{ $cartItem->product->name }}" 
                                     class="h-16 w-16 object-cover rounded-md shadow">
                                <span class="font-medium text-gray-700">{{ $cartItem->product->name }}</span>
                            </td>
                            <td class="p-4 text-gray-700">LKR {{ number_format($cartItem->product->price, 2) }}</td>
                            <td class="p-4">
                                <div class="flex items-center space-x-2">
                                    <span class="text-gray-700">{{ $cartItem->quantity }}</span>
                                </div>
                            </td>
                            <td class="p-4 text-gray-700">LKR {{ number_format($subtotal, 2) }}</td>
                            <td class="p-4 text-center">
                                <form action="{{ route('cart.remove', $cartItem->_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white text-sm rounded-lg shadow hover:bg-red-600 transition">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="flex justify-between items-center mt-8">
                <h2 class="text-2xl font-semibold text-gray-800">Total: <span class="text-pink-600">LKR {{ number_format($total, 2) }}</span></h2>
                <a href="{{ route('checkout') }}" class="px-6 py-3 bg-green-500 text-white font-bold text-lg rounded-lg shadow-lg hover:bg-green-600 transition">
                    Proceed to Checkout
                </a>
            </div>
        @else
            <p class="text-gray-600 text-center text-lg">Your cart is empty. Start shopping now! 🛍️</p>
        @endif
    </div>
@endsection
