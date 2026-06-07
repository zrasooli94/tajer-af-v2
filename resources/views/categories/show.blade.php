@extends('layout')

@section('title', $category->name)

@section('content')

<section class="bg-gradient-to-br from-tajer-green to-green-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl font-bold mb-4">{{ $category->name }}</h1>
        <p class="text-xl text-green-100 max-w-2xl mx-auto">{{ $category->description }}</p>
    </div>
</section>

<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($products->isEmpty())
            <div class="card p-12 text-center">
                <div class="text-6xl mb-4">📦</div>
                <h3 class="text-xl font-semibold mb-2">No products in this category yet</h3>
                <p class="text-gray-600">Check back soon!</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
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
                            <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $product->name }}</h3>
                            <p class="text-xl font-bold text-tajer-green">${{ number_format($product->price, 2) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @endif

    </div>
</section>

@endsection