<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | Tajer.af Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex flex-col">
            <div class="p-6 border-b border-gray-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-tajer-gold rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold">T</span>
                    </div>
                    <div>
                        <p class="font-bold">Tajer.af</p>
                        <p class="text-xs text-gray-400">Admin Panel</p>
                    </div>
                </a>
            </div>

            <nav class="flex-1 p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-tajer-green' : 'hover:bg-gray-800' }}">
                    📊 <span class="ml-3">Dashboard</span>
                </a>
                <a href="{{ route('admin.products.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.products.*') ? 'bg-tajer-green' : 'hover:bg-gray-800' }}">
                    🛍️ <span class="ml-3">Products</span>
                </a>
                <a href="{{ route('admin.orders.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.orders.*') ? 'bg-tajer-green' : 'hover:bg-gray-800' }}">
                    📦 <span class="ml-3">Orders</span>
                </a>
            </nav>

            <div class="p-4 border-t border-gray-800">
                <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-gray-400 hover:text-white">
                    ← Back to Store
                </a>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="text-sm text-red-400 hover:text-red-300 px-4">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main content -->
        <main class="flex-1 overflow-auto">

            <!-- Top bar -->
            <div class="bg-white shadow px-8 py-4 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900">@yield('page-title', 'Admin')</h1>
                <div class="flex items-center space-x-3">
                    <span class="text-sm text-gray-600">Logged in as</span>
                    <span class="font-semibold">{{ Auth::user()->name }}</span>
                    <span class="bg-tajer-gold text-white text-xs px-2 py-1 rounded-full">ADMIN</span>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        ✓ {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

    </div>

</body>
</html>