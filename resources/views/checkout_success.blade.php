@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 text-center">
        <h1 class="text-3xl font-bold text-green-600">Payment Successful! 🎉</h1>
        <p class="text-gray-700 mt-4">Thank you for your purchase. Your order has been placed successfully.</p>

        <div class="mt-6">
            <a href="{{ route('products.index') }}" class="px-6 py-2 bg-blue-600 text-white font-bold rounded-md hover:bg-blue-700 transition">
                Continue Shopping
            </a>
            <!-- <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-gray-600 text-white font-bold rounded-md hover:bg-gray-700 transition">
                Go to Dashboard
            </a> -->
        </div>
    </div>
@endsection
