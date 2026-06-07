@extends('admin.layout')

@section('title', 'Order Details')
@section('page-title', 'Order ' . $order->order_number)

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.orders.index') }}" class="text-sm text-tajer-green hover:underline">← Back to all orders</a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Order Items -->
    <div class="lg:col-span-2">
        <div class="card p-6">
            <h2 class="text-xl font-bold mb-4">Order Items</h2>
            <div class="space-y-3">
                @foreach($order->items as $item)
                    <div class="flex justify-between items-center py-3 border-b last:border-b-0">
                        <div>
                            <p class="font-semibold">{{ $item['name'] }}</p>
                            <p class="text-sm text-gray-500">${{ number_format($item['price'], 2) }} × {{ $item['quantity'] }}</p>
                        </div>
                        <p class="font-bold">${{ number_format($item['subtotal'], 2) }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 pt-6 border-t flex justify-between">
                <span class="text-lg font-bold">Total</span>
                <span class="text-2xl font-bold text-tajer-green">${{ number_format($order->total_amount, 2) }}</span>
            </div>
        </div>
    </div>

    <!-- Customer + Status -->
    <div class="space-y-6">

        <div class="card p-6">
            <h3 class="font-bold mb-4">Customer</h3>
            <p class="font-semibold">{{ $order->user->name ?? 'Guest' }}</p>
            <p class="text-sm text-gray-500">{{ $order->user->email ?? 'N/A' }}</p>
            <p class="text-sm text-gray-500 mt-2">📞 {{ $order->phone }}</p>
            <p class="text-sm text-gray-500 mt-2">📍 {{ $order->shipping_address }}</p>
        </div>

        <div class="card p-6">
            <h3 class="font-bold mb-4">Update Status</h3>
            <form action="{{ route('admin.orders.status', $order) }}" method="POST">
                @csrf
                @method('PATCH')
                <select name="status" class="w-full border border-gray-300 rounded-lg px-4 py-2 mb-3">
                    @foreach(['pending', 'confirmed', 'shipped', 'delivered', 'cancelled'] as $status)
                        <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn-primary w-full">Update Status</button>
            </form>
        </div>

        <div class="card p-6">
            <h3 class="font-bold mb-2">Order Info</h3>
            <p class="text-sm text-gray-500">Order #</p>
            <p class="font-semibold mb-2">{{ $order->order_number }}</p>
            <p class="text-sm text-gray-500">Placed</p>
            <p class="text-sm">{{ $order->created_at->format('M d, Y, g:i A') }}</p>
        </div>

    </div>
</div>

@endsection