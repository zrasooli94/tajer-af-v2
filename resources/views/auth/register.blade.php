@extends('layout')

@section('title', 'Register')

@section('content')

<section class="py-20 bg-tajer-cream min-h-screen">
    <div class="max-w-md mx-auto px-4">

        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-tajer-green mb-2">Create Account</h1>
            <p class="text-gray-600">Join Tajer.af and discover authentic Afghan craftsmanship</p>
        </div>

        <div class="card p-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium mb-1">Full Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                           required autofocus
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-tajer-green">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           required autocomplete="username"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-tajer-green">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium mb-1">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-tajer-green">
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium mb-1">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-tajer-green">
                </div>

                <button type="submit" class="btn-primary w-full">
                    Create Account
                </button>
            </form>

            <div class="text-center mt-6 text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-tajer-green font-semibold hover:underline">Sign in</a>
            </div>
        </div>
    </div>
</section>

@endsection