@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Add Product</h1>

        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 font-medium">Name:</label>
                <input type="text" name="name" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300" placeholder="Enter product name" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Price (LKR):</label>
                <input type="number" name="price" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300" placeholder="Enter price in LKR" required>
            </div>


            <div>
                <label class="block text-gray-700 font-medium">Description:</label>
                <textarea name="description" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300" placeholder="Enter product description" required></textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Image:</label>
                <input type="file" name="image" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Category:</label>
                <input type="text" name="category" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300" placeholder="Enter category" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Quantity:</label>
                <input type="number" name="quantity" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300" placeholder="Enter quantity" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">Size:</label>
                <input type="text" name="size" class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300" placeholder="Enter size (if applicable)">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-pink-600 text-white font-bold rounded-md hover:bg-pink-700 transition">
                    Add Product
                </button>
            </div>
        </form>
    </div>
@endsection
