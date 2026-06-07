@extends('layout')

@section('title', 'Order Confirmed')

@section('content')

<section class="py-20">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

        <div class="card p-12">
            <div class="text-6xl mb-6">🎉</div>
            <h1 class="text-4xl font-bold text-tajer-green mb-4">Order Confirmed!</h1>
            <p class="text-gray-600 text-lg mb-2">Thank you for shopping with Tajer.af</p>
            <p class="text-gray-500 mb-8">Your order number is:</p>

            <div class="bg-tajer-cream rounded-lg p-6 mb-8 inline-block">
                <p class="text-2xl font-bold text-tajer-green">{{ $order->order_number }}</p>
            </div>

            <div class="border-t pt-8 text-left max-w-xl mx-auto space-y-3">
                <h3 class="font-semibold text-lg mb-4">Order Details</h3>
                @foreach($order->items as $item)
                    <div class="flex justify-between">
                        <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                        <span class="font-semibold">${{ number_format($item['subtotal'], 2) }}</span>
                    </div>
                @endforeach

                <div class="border-t pt-3 flex justify-between text-lg">
                    <span class="font-bold">Total Paid</span>
                    <span class="font-bold text-tajer-green">${{ number_format($order->total_amount, 2) }}</span>
                </div>

                <div class="bg-gray-50 rounded-lg p-4 mt-6">
                    <p class="text-sm text-gray-600">
                        <strong>📦 Shipping to:</strong> {{ $order->shipping_address }}<br>
                        <strong>📞 Phone:</strong> {{ $order->phone }}
                    </p>
                </div>
            </div>

            <div class="mt-10">
                <a href="{{ route('products.index') }}" class="btn-primary inline-block">
                    Continue Shopping
                </a>
            </div>
        </div>

    </div>
</section>

@endsection