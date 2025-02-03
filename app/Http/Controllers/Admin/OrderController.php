<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use MongoDB\BSON\ObjectId;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get(); // Fetch orders with user data
    
        foreach ($orders as $order) {
            // the product_id is a valid ObjectId
            $productId = is_string($order->product_id) ? new ObjectId($order->product_id) : $order->product_id;
            
            $product = Product::where('_id', $productId)->first();
            $order->product_name = $product ? $product->name : 'Product Not Found';
        }
    
        return view('admin.orders.index', compact('orders'));
    }
    

    public function update($id)
    {
        $order = Order::findOrFail($id);

        if ($order) {
            $order->status = 'shipping';
            $order->save();
        }

        return redirect()->route('admin.orders.index')->with('success', 'Order marked as shipped.');
    }

    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();

            return redirect()->route('admin.orders.index')->with('success', 'Order removed successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.orders.index')->with('error', 'Failed to remove order.');
        }
    }
}