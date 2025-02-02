@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-12">
        <h1 class="text-3xl font-bold text-black mb-6 border-b pb-4">🛍️ Checkout</h1>

        @if(count($cartItems) > 0)
            <table class="w-full border border-gray-300 rounded-lg shadow-md mb-6">
                <thead class="bg-pink-500 text-white">
                    <tr>
                        <th class="p-4 text-left">Product</th>
                        <th class="p-4 text-left">Price</th>
                        <th class="p-4 text-left">Quantity</th>
                        <th class="p-4 text-left">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-50 divide-y divide-gray-200">
                    @php $total = 0; @endphp
                    @foreach($cartItems as $item)
                        @php $subtotal = $item->product->price * $item->quantity; @endphp
                        <tr class="hover:bg-gray-100 transition">
                            <td class="p-4 font-medium text-black">{{ $item->product->name }}</td>
                            <td class="p-4 text-gray-700">LKR {{ number_format($item->product->price, 2) }}</td>
                            <td class="p-4 text-gray-700">{{ $item->quantity }}</td>
                            <td class="p-4 text-red-500 font-bold">LKR {{ number_format($subtotal, 2) }}</td>
                        </tr>
                        @php $total += $subtotal; @endphp
                    @endforeach
                </tbody>
            </table>

            <div class="text-right text-2xl font-semibold text-black mb-6">
                Grand Total: <span class="text-pink-600">LKR {{ number_format($total, 2) }}</span>
            </div>

            <form id="payment-form" action="{{ route('checkout.process') }}" method="POST" class="bg-gray-100 p-6 rounded-lg shadow-md">
                @csrf
                <input type="hidden" name="total_amount" value="{{ $total }}">
                <input type="hidden" name="payment_intent_id" id="payment-intent-id">

                <div class="mb-4">
                    <label class="block text-black font-medium mb-2">💳 Card Information:</label>
                    <div id="card-element" class="p-4 border border-gray-300 rounded-md bg-white focus:ring focus:ring-pink-300 transition"></div>
                    <div id="card-errors" class="text-red-500 mt-2"></div>
                </div>

                <div class="flex justify-end">
                    <button id="submit-button" type="submit" class="px-6 py-3 bg-red-500 text-white font-bold rounded-lg shadow-lg hover:bg-red-600 transition">
                        Pay LKR {{ number_format($total, 2) }} with Stripe
                    </button>
                </div>
            </form>

            <script src="https://js.stripe.com/v3/"></script>
            <script>
                var stripe = Stripe('{{ env('STRIPE_KEY') }}');
                var elements = stripe.elements();
                var card = elements.create('card', { style: { base: { fontSize: '16px', color: '#333', '::placeholder': { color: '#888' } } } });
                card.mount('#card-element');

                var form = document.getElementById('payment-form');
                var submitButton = document.getElementById('submit-button');
                var cardErrors = document.getElementById('card-errors');

                form.addEventListener('submit', async function(event) {
                    event.preventDefault();
                    submitButton.disabled = true;
                    submitButton.innerText = "Processing...";

                    const {paymentIntent, error} = await stripe.confirmCardPayment("{{ $paymentIntent->client_secret }}", {
                        payment_method: {
                            card: card,
                            billing_details: {
                                name: "{{ auth()->user()->name }}",
                                email: "{{ auth()->user()->email }}"
                            }
                        }
                    });

                    if (error) {
                        cardErrors.textContent = error.message;
                        submitButton.disabled = false;
                        submitButton.innerText = "Pay LKR {{ number_format($total, 2) }} with Stripe";
                    } else {
                        document.getElementById('payment-intent-id').value = paymentIntent.id;
                        form.submit();
                    }
                });
            </script>
        @else
            <p class="text-gray-600 text-center text-lg">Your cart is empty. Start shopping now! 🛍️</p>
        @endif
    </div>
@endsection
