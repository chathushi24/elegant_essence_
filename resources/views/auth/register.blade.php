<x-guest-layout>
    <div class="flex min-h-screen bg-black items-center justify-center p-6">
        <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">
            
            <!-- Styled Register Header -->
            <div class="flex justify-center mb-6">
                <h1 class="text-3xl font-bold text-pink-600 uppercase tracking-wide border-b-4 border-red-600 pb-2">
                    Register
                </h1>
            </div>

            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-label for="name" value="{{ __('Name') }}" class="text-black font-semibold" />
                    <x-input id="name" class="block mt-1 w-full border-gray-300 focus:border-pink-600 focus:ring focus:ring-pink-400 rounded-lg" 
                             type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" class="text-black font-semibold" />
                    <x-input id="email" class="block mt-1 w-full border-gray-300 focus:border-pink-600 focus:ring focus:ring-pink-400 rounded-lg" 
                             type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" class="text-black font-semibold" />
                    <x-input id="password" class="block mt-1 w-full border-gray-300 focus:border-pink-600 focus:ring focus:ring-pink-400 rounded-lg" 
                             type="password" name="password" required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-black font-semibold" />
                    <x-input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-pink-600 focus:ring focus:ring-pink-400 rounded-lg" 
                             type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <!-- Terms & Privacy Policy -->
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" class="text-pink-600" required />
                                <div class="ms-2 text-sm text-gray-600">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-pink-600 hover:text-red-600 transition">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-pink-600 hover:text-red-600 transition">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <!-- Actions -->
                <div class="flex items-center justify-between mt-6">
                    <a class="text-sm text-pink-600 hover:text-red-600 transition duration-200 underline" 
                       href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button class="px-6 py-2 bg-pink-600 hover:bg-red-600 text-white font-bold rounded-lg transition">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
