@extends('layout')

@section('title', 'Checkout')

@section('content')

<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <h1 class="text-4xl font-bold mb-8">Checkout</h1>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Form -->
                <div class="lg:col-span-2 space-y-6">

                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card p-6">
                        <h2 class="text-xl font-semibold mb-4">Contact Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1">Full Name *</label>
                                <input type="text" name="name" required value="{{ old('name') }}"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-tajer-green">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Email *</label>
                                <input type="email" name="email" required value="{{ old('email') }}"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-tajer-green">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium mb-1">Phone *</label>
                                <input type="text" name="phone" required value="{{ old('phone') }}"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-tajer-green">
                            </div>
                        </div>
                    </div>

                    <div class="card p-6">
                        <h2 class="text-xl font-semibold mb-4">Shipping Address</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium mb-1">Address *</label>
                                <input type="text" name="address" required value="{{ old('address') }}"
                                       placeholder="123 Main Street"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-tajer-green">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">City *</label>
                                <input type="text" name="city" required value="{{ old('city') }}"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-tajer-green">
                            </div>
                            <div>
                                <label class="block text-sm font-medium mb-1">Country *</label>
                                <input type="text" name="country" required value="{{ old('country', 'Australia') }}"
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-tajer-green">
                            </div>
                        </div>
                    </div>

                    <div class="card p-6">
                        <h2 class="text-xl font-semibold mb-4">Payment</h2>
                        <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg">
                            <p class="text-sm text-yellow-800">
                                💡 <strong>Demo Mode:</strong> No real payment is processed. This is a portfolio demonstration.
                                In production, Stripe or another payment gateway would be integrated here.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Summary -->
                <aside>
                    <div class="card p-6 sticky top-24">
                        <h3 class="text-xl font-bold mb-4">Order Summary</h3>

                        <div class="space-y-3 border-b pb-4 mb-4">
                            @foreach($cartItems as $item)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-700">{{ $item['product']->name }} × {{ $item['quantity'] }}</span>
                                    <span class="font-semibold">${{ number_format($item['subtotal'], 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="space-y-2 border-b pb-4 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-semibold">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-semibold">${{ number_format($shipping, 2) }}</span>
                            </div>
                        </div>

                        <div class="flex justify-between mb-6">
                            <span class="text-lg font-bold">Total</span>
                            <span class="text-2xl font-bold text-tajer-green">${{ number_format($total, 2) }}</span>
                        </div>

                        <button type="submit" class="btn-primary w-full text-lg">
                            Place Order
                        </button>
                    </div>
                </aside>
            </div>
        </form>

    </div>
</section>

@endsection