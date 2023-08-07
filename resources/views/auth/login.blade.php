<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8" style="background-color: #191919">
        <div class="max-w-md w-full space-y-8 bg-white p-6 rounded-lg shadow-lg">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 uppercase">
                    Inloggen
                </h2>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full {{ $errors->has('email') ? 'border-red-600' : 'border-gray-300' }}" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    @if ($errors->has('email'))
                        <p class="mt-2 text-sm text-red-600">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="mb-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full {{ $errors->has('password') ? 'border-red-600' : 'border-gray-300' }}" type="password" name="password" required autocomplete="current-password" />
                    @if ($errors->has('password'))
                        <p class="mt-2 text-sm text-red-600">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="flex justify-between items-center mt-4">
                    <div>
                        <label for="remember_me" class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <div>
                        @if (Route::has('password.request'))
                            <a style="color: #d87d4a" class="underline text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </div>

                <div class="mt-4">
                    <button class="w-full flex justify-center uppercase py-2 px-4 border border-transparent rounded-md shadow-sm text-md font-medium text-black button">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>
            <div class="mt-6 text-center text-md">
                <span class="text-gray-600">Heb je nog geen account?</span>
                <a href="{{ route('register') }}" class="font-medium ml-2" style="color: #d87d4a">Registreren</a>
            </div>
        </div>
    </div>
</x-guest-layout>
