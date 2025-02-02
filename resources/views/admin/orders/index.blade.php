@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Orders</h1>

        @if ($orders->isEmpty())
            <p class="text-gray-600">No orders available.</p>
        @else
            <table class="w-full border border-gray-200 rounded-md shadow-md">
                <thead class="bg-gray-100 text-gray-800">
                    <tr>
                        <th class="p-3 text-left">Order ID</th>
                        <th class="p-3 text-left">Customer</th>
                        <th class="p-3 text-left">Product</th>
                        <th class="p-3 text-left">Quantity</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="border-t border-gray-200 hover:bg-gray-50">
                            <td class="p-3">{{ $order->_id }}</td>

                            <td class="p-3">
                                {{ $order->user ? $order->user->name : 'User Not Found' }}
                            </td>

                            <td class="p-3">
                                {{ $order->product_name ?? 'Product Not Found' }}
                            </td>

                            <td class="p-3">{{ $order->quantity }}</td>

                            <td class="p-3">
                                <span class="px-3 py-1 rounded-md text-white 
                                    {{ $order->status == 'pending' ? 'bg-yellow-500' : 'bg-green-600' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <td class="p-3 flex space-x-2">
                                @if ($order->status == 'pending')
                                    <form action="{{ route('admin.orders.update', $order->_id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                            Mark as Shipped
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.orders.destroy', $order->_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                            Remove
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
