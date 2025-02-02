<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // ✅ Show Cart
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();

        // ✅ Ensure `$cartItems` is always an array
        if (!$cartItems || $cartItems->isEmpty()) {
            $cartItems = collect([]); // Return an empty collection
        }

        return view('cart.index', compact('cartItems'));
    }

    // ✅ Add to Cart (Fix for MongoDB)
    public function addToCart(Request $request, $id)
    {
        $product = Product::where('_id', $id)->first();

        if (!$product) {
            return back()->with('error', 'Product not found.');
        }

        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();

        if ($cartItem) {
            if ($cartItem->quantity < $product->quantity) {
                $cartItem->quantity += 1;
                $cartItem->save();
            } else {
                return back()->with('error', 'Not enough stock available.');
            }
        } else {
            Cart::create([
                'user_id'    => Auth::id(),
                'product_id' => $id,
                'quantity'   => 1,
            ]);
        }

        return back()->with('success', 'Product added to cart.');
    }

    // ✅ Update Cart
    public function update(Request $request, $id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('_id', $id)->first();

        if ($cartItem) {
            $product = Product::where('_id', $cartItem->product_id)->first();

            if (!$product) {
                return back()->with('error', 'Product not found.');
            }

            if ($product->quantity < $request->quantity) {
                return back()->with('error', 'Not enough stock.');
            }

            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }

        return back()->with('success', 'Cart updated.');
    }

    // ✅ Remove from Cart
    public function remove($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('_id', $id)->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return back()->with('success', 'Item removed from cart.');
    }
}
