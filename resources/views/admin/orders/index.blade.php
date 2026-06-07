@extends('admin.layout')

@section('title', 'Orders')
@section('page-title', 'Orders')

@section('content')

<div class="mb-6">
    <p class="text-gray-600">{{ $orders->total() }} total orders</p>
</div>

<!-- Status filter -->
<div class="mb-6 flex flex-wrap gap-2">
    <a href="{{ route('admin.orders.index') }}" class="px-3 py-1 rounded-full text-sm {{ !request('status') ? 'bg-tajer-green text-white' : 'bg-white border' }}">All</a>
    @foreach(['pending', 'confirmed', 'shipped', 'delivered', 'cancelled'] as $status)
        <a href="{{ route('admin.orders.index', ['status' => $status]) }}" class="px-3 py-1 rounded-full text-sm capitalize {{ request('status') === $status ? 'bg-tajer-green text-white' : 'bg-white border' }}">
            {{ $status }}
        </a>
    @endforeach
</div>

<div class="card overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Order</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Customer</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Total</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Status</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Date</th>
                <th class="text-right px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4 font-semibold">{{ $order->order_number }}</td>
                    <td class="px-6 py-4 text-sm">{{ $order->user->name ?? 'Guest' }}</td>
                    <td class="px-6 py-4 font-semibold">${{ number_format($order->total_amount, 2) }}</td>
                    <td class="px-6 py-4">
                        <span class="text-xs px-2 py-1 rounded-full
                            {{ $order->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $order->status === 'shipped' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $order->status === 'delivered' ? 'bg-gray-100 text-gray-800' : '' }}
                            {{ $order->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.orders.show', $order) }}" class="text-sm text-tajer-green hover:underline">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $orders->links() }}
</div>

@endsection