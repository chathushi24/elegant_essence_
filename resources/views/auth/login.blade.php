<x-guest-layout>
    <div class="flex min-h-screen bg-black items-center justify-center p-6">
        <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">
            <!-- Styled Login Header -->
            <div class="flex justify-center mb-6">
                <h1 class="text-3xl font-bold text-pink-600 uppercase tracking-wide border-b-4 border-red-600 pb-2">
                    Login
                </h1>
            </div>

            <!-- Session Status -->
            <x-validation-errors class="mb-4" />
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label for="email" value="{{ __('Email') }}" class="text-black font-semibold" />
                    <x-input id="email" class="block mt-1 w-full border-gray-300 focus:border-pink-600 focus:ring focus:ring-pink-400 rounded-lg" 
                             type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" class="text-black font-semibold" />
                    <x-input id="password" class="block mt-1 w-full border-gray-300 focus:border-pink-600 focus:ring focus:ring-pink-400 rounded-lg" 
                             type="password" name="password" required autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center text-gray-700">
                        <x-checkbox id="remember_me" name="remember" class="text-pink-600" />
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-pink-600 hover:text-red-600 transition duration-200 underline" 
                           href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif

                    <x-button class="px-6 py-2 bg-pink-600 hover:bg-red-600 text-white font-bold rounded-lg transition">
                        {{ __('Log in') }}
                    </x-button>
                </div>
                
                <!-- Register Link -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        {{ __("Don't have an account?") }}
                        <a href="{{ route('register') }}" 
                           class="text-pink-600 font-semibold hover:text-red-600 underline transition duration-200">
                            {{ __('Create an account') }}
                        </a>
                    </p>
                </div>

                <!-- Admin Login Button -->
            <div class="mt-4 text-center">
                <a href="{{ route('admin.login') }}" 
                class="text-sm text-pink-600 font-semibold hover:text-pink-800 underline transition duration-200">
                    Admin Login
                </a>
            </div>

            </form>
        </div>
    </div>
</x-guest-layout>
