<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Auth;

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
            return redirect()->route('cart.index')->with('error', 'Total amount must be at least $0.50.');
        }

        // ✅ Stripe Integration
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $paymentIntent = PaymentIntent::create([
            'amount' => max(50, intval($total * 100)), // Convert to cents
            'currency' => 'usd',
            'description' => 'Order Payment',
            'metadata' => ['user_id' => Auth::id()]
        ]);

        return view('checkout', compact('cartItems', 'total', 'paymentIntent'));
    }

    // ✅ Process Payment
    public function process(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        foreach ($cartItems as $item) {
            $product = Product::where('_id', $item->product_id)->first();

            if (!$product) {
                return redirect()->route('cart.index')->with('error', 'One or more products are no longer available.');
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

        return redirect()->route('checkout.success');
    }

    // ✅ Payment Success
    public function success()
    {
        return view('checkout_success');
    }

    // ✅ Payment Canceled
    public function cancel()
    {
        return redirect()->route('cart.index')->with('error', 'Payment was canceled.');
    }
}
