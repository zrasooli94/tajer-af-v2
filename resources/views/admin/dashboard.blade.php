@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <div class="card p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-gray-500 text-sm">Total Revenue</span>
            <span class="text-2xl">💰</span>
        </div>
        <p class="text-3xl font-bold text-tajer-green">${{ number_format($stats['revenue'], 2) }}</p>
    </div>

    <div class="card p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-gray-500 text-sm">Total Orders</span>
            <span class="text-2xl">📦</span>
        </div>
        <p class="text-3xl font-bold">{{ $stats['total_orders'] }}</p>
        @if($stats['pending_orders'] > 0)
            <p class="text-xs text-orange-600 mt-1">{{ $stats['pending_orders'] }} pending</p>
        @endif
    </div>

    <div class="card p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-gray-500 text-sm">Products</span>
            <span class="text-2xl">🛍️</span>
        </div>
        <p class="text-3xl font-bold">{{ $stats['total_products'] }}</p>
        @if($stats['low_stock'] > 0)
            <p class="text-xs text-red-600 mt-1">{{ $stats['low_stock'] }} low stock</p>
        @endif
    </div>

    <div class="card p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-gray-500 text-sm">Customers</span>
            <span class="text-2xl">👥</span>
        </div>
        <p class="text-3xl font-bold">{{ $stats['total_users'] }}</p>
    </div>
</div>

<!-- Two-column layout -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <!-- Recent Orders -->
    <div class="card p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold">Recent Orders</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-sm text-tajer-green hover:underline">View all →</a>
        </div>

        @if($recentOrders->isEmpty())
            <p class="text-gray-500 text-sm">No orders yet.</p>
        @else
            <div class="space-y-3">
                @foreach($recentOrders as $order)
                    <a href="{{ route('admin.orders.show', $order) }}" class="block p-3 hover:bg-gray-50 rounded-lg border">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold text-sm">{{ $order->order_number }}</p>
                                <p class="text-xs text-gray-500">{{ $order->user->name ?? 'Guest' }} · {{ $order->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-tajer-green">${{ number_format($order->total_amount, 2) }}</p>
                                <span class="text-xs px-2 py-1 rounded-full
                                    {{ $order->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $order->status === 'shipped' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $order->status === 'delivered' ? 'bg-gray-100 text-gray-800' : '' }}
                                    {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Low Stock -->
    <div class="card p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold">Low Stock Alert</h2>
            <a href="{{ route('admin.products.index') }}" class="text-sm text-tajer-green hover:underline">Manage →</a>
        </div>

        @if($lowStockProducts->isEmpty())
            <p class="text-gray-500 text-sm">✅ All products well-stocked.</p>
        @else
            <div class="space-y-3">
                @foreach($lowStockProducts as $product)
                    <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                        <div>
                            <p class="font-semibold text-sm">{{ $product->name }}</p>
                            <p class="text-xs text-gray-500">${{ number_format($product->price, 2) }}</p>
                        </div>
                        <span class="bg-red-200 text-red-800 text-xs px-3 py-1 rounded-full font-bold">
                            Only {{ $product->stock }} left
                        </span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

@endsection