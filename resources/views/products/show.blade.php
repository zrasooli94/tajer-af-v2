@extends('layout')

@section('title', $product->name)

@section('content')

<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumb -->
        <nav class="text-sm text-gray-600 mb-8">
            <a href="{{ route('home') }}" class="hover:text-tajer-green">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('products.index') }}" class="hover:text-tajer-green">Products</a>
            <span class="mx-2">/</span>
            <a href="{{ route('categories.show', $product->category->slug) }}" class="hover:text-tajer-green">{{ $product->category->name }}</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Image -->
            <div class="card aspect-square bg-gradient-to-br from-tajer-cream to-amber-100 flex items-center justify-center">
                <div class="text-9xl">
                    @php
                        $emojis = ['🧶', '🌶️', '🥜', '👘', '💎', '📚'];
                    @endphp
                    {{ $emojis[($product->category_id - 1) % 6] ?? '🛍️' }}
                </div>
            </div>

            <!-- Details -->
            <div>
                <p class="text-sm text-gray-500 uppercase tracking-wide mb-2">{{ $product->category->name }}</p>
                <h1 class="text-4xl font-bold mb-4">{{ $product->name }}</h1>

                <div class="flex items-center space-x-4 mb-6">
                    <p class="text-4xl font-bold text-tajer-green">${{ number_format($product->price, 2) }}</p>
                    @if($product->is_featured)
                        <span class="bg-tajer-gold text-white px-3 py-1 rounded-full text-xs font-semibold">FEATURED</span>
                    @endif
                </div>

                <div class="border-t border-gray-200 pt-6 mb-6">
                    <h3 class="font-semibold mb-2">Description</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                </div>

                <div class="border-t border-gray-200 pt-6 mb-6">
                    @if($product->stock > 0)
                        <p class="text-green-600 font-medium mb-4">✓ In Stock ({{ $product->stock }} available)</p>
                    @else
                        <p class="text-tajer-red font-medium mb-4">✗ Out of Stock</p>
                    @endif

                    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('cart.add', $product) }}" method="POST">
    @csrf
    <div class="flex items-center space-x-4 mb-6">
        <label class="font-medium" for="quantity">Quantity:</label>
        <select name="quantity" id="quantity" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-tajer-green">
            @for($i = 1; $i <= min($product->stock, 10); $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>

    <button type="submit" class="btn-primary w-full text-lg" {{ $product->stock < 1 ? 'disabled' : '' }}>
        🛒 Add to Cart
    </button>
</form>
                </div>

                <div class="border-t border-gray-200 pt-6 space-y-3 text-sm text-gray-600">
                    <p>🚚 <strong>Worldwide shipping</strong> · 7-14 business days</p>
                    <p>🔒 <strong>Secure checkout</strong> · SSL encrypted</p>
                    <p>↩️ <strong>30-day returns</strong> · Hassle-free</p>
                </div>
            </div>
        </div>

        <!-- Related products -->
        @if($relatedProducts->isNotEmpty())
            <div class="mt-20">
                <h2 class="text-2xl font-bold mb-8">You might also like</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('products.show', $related->slug) }}" class="card group">
                            <div class="aspect-square bg-gradient-to-br from-tajer-cream to-amber-100 flex items-center justify-center">
                                <div class="text-6xl group-hover:scale-110 transition">
                                    {{ $emojis[($related->category_id - 1) % 6] ?? '🛍️' }}
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $related->name }}</h3>
                                <p class="text-xl font-bold text-tajer-green">${{ number_format($related->price, 2) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</section>

@endsection