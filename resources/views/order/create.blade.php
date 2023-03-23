<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Checkout' }}
        </h2>
    </x-slot>
    <div class="py-12 stripe">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row mb-3">
                        <div class="col-sm">
                            <h5>You're about to buy this following product</h5>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><img src="{{ $product->image_url }}" width="48"></td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price_formatted }}</td>
                                    <td>{{ $quantity }}</td>
                                    <td>${{ number_format($amount, 2) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <form id="payment-form">
                                <input type="hidden" name="product_id" value="{{encrypt($product->id)}}">
                                <input type="hidden" name="amount" value="{{$amount}}">
                                <input type="hidden" name="quantity" value="{{$quantity}}">
                                <input type="hidden" name="email" value="{{$email}}">
                                <div id="link-authentication-element">
                                    <!--Stripe.js injects the Link Authentication Element-->
                                </div>
                                <div id="payment-element">
                                    <!--Stripe.js injects the Payment Element-->
                                </div>
                                <button id="submit">
                                    <div class="spinner hidden" id="spinner"></div>
                                    <span id="button-text">Pay now</span>
                                </button>
                                <div id="payment-message" class="hidden"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
