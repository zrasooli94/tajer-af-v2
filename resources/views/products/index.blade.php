@extends('layout')

@section('title', 'All Products')

@section('content')

<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold mb-2">All Products</h1>
        <p class="text-gray-600 mb-8">{{ $products->total() }} products available</p>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar filters -->
            <aside class="lg:col-span-1">
                <div class="card p-6 sticky top-24">
                    <h3 class="font-semibold mb-4">Categories</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('products.index') }}"
                               class="{{ !request('category') ? 'text-tajer-green font-semibold' : 'text-gray-700' }} hover:text-tajer-green">
                                All Products
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('products.index', ['category' => $category->id]) }}"
                                   class="{{ request('category') == $category->id ? 'text-tajer-green font-semibold' : 'text-gray-700' }} hover:text-tajer-green">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- Products grid -->
            <div class="lg:col-span-3">
                @if($products->isEmpty())
                    <div class="card p-12 text-center">
                        <div class="text-6xl mb-4">🔍</div>
                        <h3 class="text-xl font-semibold mb-2">No products found</h3>
                        <p class="text-gray-600">Try adjusting your search or filters.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            <a href="{{ route('products.show', $product->slug) }}" class="card group">
                                <div class="aspect-square bg-gradient-to-br from-tajer-cream to-amber-100 flex items-center justify-center">
                                    <div class="text-6xl group-hover:scale-110 transition">
                                        @php
                                            $emojis = ['🧶', '🌶️', '🥜', '👘', '💎', '📚'];
                                        @endphp
                                        {{ $emojis[($product->category_id - 1) % 6] ?? '🛍️' }}
                                    </div>
                                </div>
                                <div class="p-4">
                                    <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">{{ $product->category->name }}</p>
                                    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $product->name }}</h3>
                                    <div class="flex items-center justify-between">
                                        <p class="text-xl font-bold text-tajer-green">${{ number_format($product->price, 2) }}</p>
                                        @if($product->stock < 5)
                                            <span class="text-xs text-tajer-red font-medium">Only {{ $product->stock }} left</span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection