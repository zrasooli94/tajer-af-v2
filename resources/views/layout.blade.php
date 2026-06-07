<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tajer.af') | Tajer.af</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-tajer-green rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">T</span>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">Tajer<span class="text-tajer-green">.af</span></span>
                </a>

                <!-- Search bar -->
                <form action="{{ route('products.index') }}" method="GET" class="hidden md:flex flex-1 max-w-lg mx-8">
                    <input type="text" name="search" placeholder="Search Afghan products..."
                           value="{{ request('search') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-tajer-green">
                    <button type="submit" class="bg-tajer-green text-white px-6 py-2 rounded-r-lg hover:bg-green-700 transition">
                        Search
                    </button>
                </form>

                <!-- Nav -->
                <nav class="flex items-center space-x-6">
    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-tajer-green font-medium">Products</a>

    @php
        $cartCount = array_sum(session('cart', []));
    @endphp

    <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-tajer-green font-medium relative">
        🛒 Cart
        @if($cartCount > 0)
            <span class="absolute -top-2 -right-3 bg-tajer-red text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ $cartCount }}</span>
        @endif
    </a>

    @auth
        <div class="flex items-center space-x-3">
            <span class="text-sm text-gray-700">Hi, <strong>{{ Auth::user()->name }}</strong></span>

            @if(Auth::user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="bg-tajer-gold text-white text-xs px-3 py-1 rounded-full hover:bg-yellow-600">
                    ADMIN PANEL →
                </a>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-sm text-tajer-red hover:underline">
                    Logout
                </button>
            </form>
        </div>
    @else
        <a href="{{ route('login') }}" class="text-gray-700 hover:text-tajer-green font-medium">Sign in</a>
        <a href="{{ route('register') }}" class="btn-primary text-sm">Register</a>
    @endauth
</nav>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Tajer.af</h3>
                    <p class="text-gray-400 text-sm">Authentic Afghan products, delivered worldwide. Rebuilding heritage one order at a time.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Shop</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('products.index') }}" class="hover:text-white">All Products</a></li>
                        <li><a href="#" class="hover:text-white">Featured</a></li>
                        <li><a href="#" class="hover:text-white">New Arrivals</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">About</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white">Our Story</a></li>
                        <li><a href="#" class="hover:text-white">Artisans</a></li>
                        <li><a href="#" class="hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Help</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white">Shipping</a></li>
                        <li><a href="#" class="hover:text-white">Returns</a></li>
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-500">
                <p>© 2026 Tajer.af · Rebuilt with ❤️ by <a href="https://github.com/zrasooli94" class="underline hover:text-white">Zaker Hussain Rasooli</a></p>
            </div>
        </div>
    </footer>

</body>
</html>