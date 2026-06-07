@extends('admin.layout')

@section('title', 'Products')
@section('page-title', 'Products')

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-gray-600">{{ $products->total() }} total products</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn-primary">
        + Add Product
    </a>
</div>

<!-- Search -->
<form action="{{ route('admin.products.index') }}" method="GET" class="mb-6">
    <div class="flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Search products..."
               class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-tajer-green">
        <button type="submit" class="btn-primary">Search</button>
        @if(request('search'))
            <a href="{{ route('admin.products.index') }}" class="btn-secondary">Clear</a>
        @endif
    </div>
</form>

<!-- Products table -->
<div class="card overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Product</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Category</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Price</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Stock</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Status</th>
                <th class="text-right px-6 py-3 text-xs font-semibold text-gray-600 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <p class="font-semibold">{{ $product->name }}</p>
                        @if($product->is_featured)
                            <span class="text-xs bg-tajer-gold text-white px-2 py-1 rounded-full">Featured</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm">{{ $product->category->name }}</td>
                    <td class="px-6 py-4 font-semibold">${{ number_format($product->price, 2) }}</td>
                    <td class="px-6 py-4">
                        <span class="{{ $product->stock < 5 ? 'text-red-600 font-bold' : '' }}">
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs px-2 py-1 rounded-full {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-sm text-tajer-green hover:underline">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline ml-3" onsubmit="return confirm('Delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-tajer-red hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        No products found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $products->links() }}
</div>

@endsection