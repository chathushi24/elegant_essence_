<x-guest-layout>
    <div class="flex min-h-screen bg-black items-center justify-center p-6">
        <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">
            <!-- Styled Login Header -->
            <div class="flex justify-center mb-6">
                <h1 class="text-3xl font-bold text-pink-600 uppercase tracking-wide border-b-4 border-red-600 pb-2">
                    Admin Login
                </h1>
            </div>

            <!-- Session Status -->
            <x-validation-errors class="mb-4" />
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-black font-semibold mb-1">Email:</label>
                    <input id="email" type="email" name="email"
                           class="block w-full border-gray-300 focus:border-pink-600 focus:ring focus:ring-pink-400 rounded-lg p-2 @error('email') border-red-500 @enderror"
                           value="{{ old('email') }}" required autofocus autocomplete="username">
                    @error('email')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block text-black font-semibold mb-1">Password:</label>
                    <input id="password" type="password" name="password"
                           class="block w-full border-gray-300 focus:border-pink-600 focus:ring focus:ring-pink-400 rounded-lg p-2 @error('password') border-red-500 @enderror"
                           required autocomplete="current-password">
                    @error('password')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Login Button -->
                <div class="mt-6 text-center">
                    <button type="submit"
                            class="w-full bg-pink-600 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
    </x-guest-layout>
