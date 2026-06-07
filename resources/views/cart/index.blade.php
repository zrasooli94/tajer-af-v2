@extends('layout')

@section('title', 'Shopping Cart')

@section('content')

<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <h1 class="text-4xl font-bold mb-2">Shopping Cart</h1>
        <p class="text-gray-600 mb-8">{{ count($cartItems) }} {{ count($cartItems) === 1 ? 'item' : 'items' }} in your cart</p>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(empty($cartItems))
            <div class="card p-12 text-center">
                <div class="text-6xl mb-4">🛒</div>
                <h3 class="text-2xl font-semibold mb-2">Your cart is empty</h3>
                <p class="text-gray-600 mb-6">Browse our catalog and add some Afghan treasures!</p>
                <a href="{{ route('products.index') }}" class="btn-primary inline-block">
                    Shop Products
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Items list -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cartItems as $item)
                        <div class="card p-6">
                            <div class="flex items-start gap-4">
                                <div class="w-24 h-24 bg-gradient-to-br from-tajer-cream to-amber-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <div class="text-4xl">
                                        @php
                                            $emojis = ['🧶', '🌶️', '🥜', '👘', '💎', '📚'];
                                        @endphp
                                        {{ $emojis[($item['product']->category_id - 1) % 6] ?? '🛍️' }}
                                    </div>
                                </div>

                                <div class="flex-1">
                                    <a href="{{ route('products.show', $item['product']->slug) }}" class="font-semibold text-lg hover:text-tajer-green block">
                                        {{ $item['product']->name }}
                                    </a>
                                    <p class="text-sm text-gray-500 mb-3">{{ $item['product']->category->name }}</p>

                                    <div class="flex items-center justify-between flex-wrap gap-2">
                                        <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <label class="text-sm">Qty:</label>
                                            <select name="quantity" onchange="this.form.submit()" class="border border-gray-300 rounded px-2 py-1 text-sm">
                                                @for($i = 1; $i <= min($item['product']->stock, 10); $i++)
                                                    <option value="{{ $i }}" {{ $item['quantity'] == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </form>

                                        <div class="flex items-center gap-4">
                                            <p class="font-bold text-lg text-tajer-green">${{ number_format($item['subtotal'], 2) }}</p>
                                            <form action="{{ route('cart.remove', $item['product']) }}" method="POST" onsubmit="return confirm('Remove this item?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-tajer-red hover:underline text-sm">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Clear entire cart?')">
                        @csrf
                        <button type="submit" class="text-sm text-gray-600 hover:text-tajer-red underline">Clear cart</button>
                    </form>
                </div>

                <!-- Summary -->
                <aside>
                    <div class="card p-6 sticky top-24">
                        <h3 class="text-xl font-bold mb-4">Order Summary</h3>

                        <div class="space-y-3 border-b pb-4 mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-semibold">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-semibold">${{ number_format($shipping, 2) }}</span>
                            </div>
                        </div>

                        <div class="flex justify-between mb-6">
                            <span class="text-lg font-bold">Total</span>
                            <span class="text-2xl font-bold text-tajer-green">${{ number_format($total, 2) }}</span>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="btn-primary w-full text-center block">
                            Proceed to Checkout →
                        </a>

                        <a href="{{ route('products.index') }}" class="block text-center mt-4 text-tajer-green hover:underline text-sm">
                            ← Continue shopping
                        </a>
                    </div>
                </aside>
            </div>
        @endif

    </div>
</section>

@endsection