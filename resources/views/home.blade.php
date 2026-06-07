@extends('layout')

@section('title', 'Home')

@section('content')

<!-- Hero section -->
<section class="bg-gradient-to-br from-tajer-green to-green-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
                    Authentic Afghan Products, <span class="text-tajer-gold">Worldwide</span>
                </h1>
                <p class="text-xl text-green-100 mb-8">
                    Handwoven carpets, premium saffron, lapis lazuli, and centuries-old craftsmanship — sourced directly from Afghan artisans.
                </p>
                <a href="{{ route('products.index') }}" class="inline-block bg-white text-tajer-green px-8 py-4 rounded-lg font-semibold text-lg hover:bg-tajer-cream transition">
                    Shop Now →
                </a>
            </div>
            <div class="hidden md:block">
                <div class="text-9xl text-center">🕌</div>
            </div>
        </div>
    </div>
</section>

<!-- Categories -->
<section class="py-16 bg-tajer-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Shop by Category</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}"
                   class="card p-6 text-center hover:scale-105 transition">
                    <div class="text-4xl mb-3">
                        @php
                            $icons = ['🧶', '🌶️', '🥜', '👘', '💎', '📚'];
                        @endphp
                        {{ $icons[$loop->index] ?? '🛍️' }}
                    </div>
                    <h3 class="font-semibold text-gray-900">{{ $category->name }}</h3>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-12">
            <h2 class="text-3xl font-bold">Featured Products</h2>
            <a href="{{ route('products.index') }}" class="text-tajer-green font-semibold hover:underline">View all →</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
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
                        <p class="text-xl font-bold text-tajer-green">${{ number_format($product->price, 2) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Trust section -->
<section class="py-16 bg-tajer-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div>
                <div class="text-4xl mb-3">🌍</div>
                <h3 class="font-semibold text-lg mb-2">Worldwide Shipping</h3>
                <p class="text-gray-600 text-sm">Delivered to 50+ countries with secure packaging.</p>
            </div>
            <div>
                <div class="text-4xl mb-3">🤝</div>
                <h3 class="font-semibold text-lg mb-2">Fair Trade</h3>
                <p class="text-gray-600 text-sm">Sourced directly from Afghan artisans, ensuring fair pay.</p>
            </div>
            <div>
                <div class="text-4xl mb-3">✨</div>
                <h3 class="font-semibold text-lg mb-2">Authentic Quality</h3>
                <p class="text-gray-600 text-sm">Every product handpicked for cultural authenticity.</p>
            </div>
        </div>
    </div>
</section>

@endsection