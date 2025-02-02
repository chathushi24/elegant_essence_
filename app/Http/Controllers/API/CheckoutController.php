<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\PaymentIntent;

    class CheckoutController extends Controller
    {
        // ✅ Show Checkout Page
        public function index()
        {
            $cartItems = Cart::where('user_id', Auth::id())->get() ?? collect([]);

            // Ensure products exist in the cart
            $total = $cartItems->sum(function ($item) {
                $product = Product::where('_id', $item->product_id)->first();
                return $product ? ($product->price * $item->quantity) : 0;
            });

            if ($total < 0.50) {
                return response()->json(['error' => 'Total amount must be at least $0.50.'], 400);
            }

            // ✅ Stripe Integration
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $paymentIntent = PaymentIntent::create([
                'amount' => max(50, intval($total * 100)), // Convert to cents
                'currency' => 'usd',
                'description' => 'Order Payment',
                'metadata' => ['user_id' => Auth::id()]
            ]);

            return response()->json(['cartItems' => $cartItems, 'total' => $total, 'paymentIntent' => $paymentIntent]);
        }

        // ✅ Process Payment
        public function process(Request $request)
        {
            $cartItems = Cart::where('user_id', Auth::id())->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['error' => 'Your cart is empty.'], 400);
            }

            foreach ($cartItems as $item) {
                $product = Product::where('_id', $item->product_id)->first();

                if (!$product) {
                    return response()->json(['error' => 'One or more products are no longer available.'], 400);
                }

                Order::create([
                    'user_id' => Auth::id(),
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'status' => 'pending'
                ]);

                // ✅ Reduce Stock
                $product->quantity -= $item->quantity;
                $product->save();
            }

            // ✅ Clear Cart after Purchase
            Cart::where('user_id', Auth::id())->delete();

            return response()->json(['message' => 'Payment successful.'], 200);
        }

        // ✅ Payment Success
        public function success()
        {
            return response()->json(['message' => 'Payment success.'], 200);
        }

        // ✅ Payment Canceled
        public function cancel()
        {
            return response()->json(['error' => 'Payment was canceled.'], 400);
        }
    }
