<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use MongoDB\BSON\ObjectId; // Import MongoDB ObjectId

class CartController extends Controller
{

    public function index(Request $request)
    {
        // ✅ Ensure the user is authenticated
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // ✅ Get user's cart items
        $cartItems = Cart::where('user_id', $user->_id)
                        ->with('product') // ✅ Eager load product details
                        ->get();

        return response()->json(['data' => $cartItems], 200);
    }


    public function addToCart(Request $request, $id)
    {
        // ✅ Ensure the user is authenticated using Sanctum
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // ✅ Convert the ID to MongoDB ObjectId properly
        if (!preg_match('/^[0-9a-fA-F]{24}$/', $id)) {
            return response()->json(['error' => 'Invalid Product ID format'], 400);
        }
        $objectId = new ObjectId($id);

        // ✅ Find the product in the database
        $product = Product::where('_id', $objectId)->first();
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // ✅ Check if the product already exists in the user's cart
        $cartItem = Cart::where('user_id', $user->_id)
                        ->where('product_id', $objectId)
                        ->first();

        if ($cartItem) {
            // ✅ Ensure stock is available before increasing quantity
            if ($cartItem->quantity < $product->quantity) {
                $cartItem->increment('quantity');
            } else {
                return response()->json(['error' => 'Not enough stock available'], 400);
            }
        } else {
            // ✅ Add new product to cart
            Cart::create([
                'user_id'    => $user->_id,
                'product_id' => $objectId,
                'quantity'   => 1,
            ]);
        }

        return response()->json(['success' => 'Product added to cart'], 200);
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