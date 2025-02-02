<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class CartController extends Controller
{

    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();

        // ✅ Ensure `$cartItems` is always an array
        if (!$cartItems || $cartItems->isEmpty()) {
            $cartItems = collect([]); // Return an empty collection
        }

        return response()->json([
            'data' => $cartItems,
        ]);
    }

    public function addToCart( $id)
    {
        $product = Product::where('_id', $id)->first();

        if (!$product) {
            return response()->json([
                'error' => 'Product not found.',
            ], 404);
        }

        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $id)->first();

        if ($cartItem) {
            if ($cartItem->quantity < $product->quantity) {
                $cartItem->quantity += 1;
                $cartItem->save();
            } else {
                return response()->json([
                    'error' => 'Not enough stock available.',
                ], 400);
            }
        } else {
            Cart::create([
                'user_id'    => Auth::id(),
                'product_id' => $id,
                'quantity'   => 1,
            ]);
        }

        return response()->json([
            'success' => 'Product added to cart.',
        ]);
    }

    // ✅ Update Cart
    public function update(Request $request, $id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('_id', $id)->first();

        if ($cartItem) {
            $product = Product::where('_id', $cartItem->product_id)->first();

            if (!$product) {
                return response()->json([
                    'error' => 'Product not found.',
                ], 404);
            }

            if ($product->quantity < $request->quantity) {
                return response()->json([
                    'error' => 'Not enough stock.',
                ], 400);
            }

            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }

        return response()->json([
            'success' => 'Cart updated.',
        ]);
    }

    // ✅ Remove from Cart
    public function remove($id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->where('_id', $id)->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return response()->json([
            'success' => 'Item removed from cart.',
        ]);
    }
}
   