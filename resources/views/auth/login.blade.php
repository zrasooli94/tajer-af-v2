@extends('layout')

@section('title', 'Sign In')

@section('content')

<section class="py-20 bg-tajer-cream min-h-screen">
    <div class="max-w-md mx-auto px-4">

        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-tajer-green mb-2">Welcome Back</h1>
            <p class="text-gray-600">Sign in to your Tajer.af account</p>
        </div>

        <div class="card p-8">

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           required autofocus autocomplete="username"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-tajer-green">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium mb-1">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-tajer-green">
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center text-sm">
                        <input type="checkbox" name="remember" class="rounded text-tajer-green">
                        <span class="ml-2 text-gray-700">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-tajer-green hover:underline">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn-primary w-full">
                    Sign In
                </button>
            </form>

            <div class="text-center mt-6 text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-tajer-green font-semibold hover:underline">Register</a>
            </div>

            <div class="border-t mt-6 pt-6 text-center">
                <p class="text-xs text-gray-500 mb-2">Demo accounts (already in database):</p>
                <p class="text-xs text-gray-600">👤 Customer: <code>demo@tajer.af</code> / <code>demo123</code></p>
                <p class="text-xs text-gray-600">👑 Admin: <code>admin@tajer.af</code> / <code>admin123</code></p>
            </div>

        </div>
    </div>
</section>

@endsection