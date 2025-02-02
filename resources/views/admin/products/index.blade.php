@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Products</h1>
            <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-pink-600 text-white font-bold rounded-md hover:bg-pink-700 transition">
                + Add Product
            </a>
        </div>

        <div class="overflow-x-auto max-h-[500px] overflow-y-auto">
    <table class="w-full border border-gray-200 rounded-md shadow-md">
        <thead class="bg-gray-100 text-gray-800">
            <tr>
                <th class="p-3 text-left">Name</th>
                <th class="p-3 text-left">Price</th>
                <th class="p-3 text-left">Category</th>
                <th class="p-3 text-left">Quantity</th>
                <th class="p-3 text-left">Size</th>
                <th class="p-3 text-left">Description</th>
                <th class="p-3 text-left">Image</th>
                <th class="p-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr class="border-t border-gray-200 hover:bg-gray-50">
                    <td class="p-3">{{ $product->name }}</td>
                    <td class="p-3">LKR {{ number_format($product->price, 2) }}</td>
                    <td class="p-3">{{ $product->category }}</td>
                    <td class="p-3">{{ $product->quantity }}</td>
                    <td class="p-3">{{ $product->size ?? 'N/A' }}</td>
                    <td class="p-3 truncate max-w-xs" title="{{ $product->description }}">{{ Str::limit($product->description, 50) }}</td>
                    <td class="p-3">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-16 h-16 object-cover rounded">
                        @else
                            No Image
                        @endif
                    </td>
                    <td class="p-3 flex space-x-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="px-3 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition">
                            Edit
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    </div>
@endsection
