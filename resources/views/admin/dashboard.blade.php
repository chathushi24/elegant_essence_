@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Admin Dashboard</h1>
        
        <p class="text-gray-600 mb-6">Welcome, <span class="font-bold">{{ auth()->guard('admin')->user()->name }}</span>!</p>

        <div class="flex space-x-4">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-2 bg-blue-600 text-white font-bold rounded-md hover:bg-blue-700 transition">
                Manage Products
            </a>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="px-6 py-2 bg-red-600 text-white font-bold rounded-md hover:bg-red-700 transition">
                    Logout
                </button>
            </form>
        </div>
    </div>
@endsection
