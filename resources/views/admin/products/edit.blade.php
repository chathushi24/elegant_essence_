@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Product</h1>

        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 font-medium">Name:</label>
                <input type="text" name="name" value="{{ $product->name }}" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Price:</label>
                <input type="number" name="price" value="{{ $product->price }}" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Description:</label>
                <textarea name="description" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300" required>{{ $product->description }}</textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Current Image:</label>
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-32 object-cover mb-2">
                @endif
                <input type="file" name="image" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Category:</label>
                <input type="text" name="category" value="{{ $product->category }}" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Quantity:</label>
                <input type="number" name="quantity" value="{{ $product->quantity }}" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Size:</label>
                <input type="text" name="size" value="{{ $product->size }}" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.products.index') }}" class="px-6 py-2 bg-gray-600 text-white font-bold rounded-md hover:bg-gray-700 transition">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-pink-600 text-white font-bold rounded-md hover:bg-pink-700 transition">
                    Update Product
                </button>
            </div>
        </form>
    </div>
@endsection
