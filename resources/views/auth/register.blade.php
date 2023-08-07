<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8" style="background-color: #191919">
        <div class="max-w-md w-full space-y-8 bg-white p-6 rounded-lg shadow-lg">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 uppercase">
                    Maak een account
                </h2>
            </div>
            <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="relative">
                    <input id="name" name="name" type="text" autocomplete="name" required
                           class="mt-1 block w-full shadow-sm border-gray-300 rounded-md pl-3"
                           value="{{ old('name') }}" autofocus placeholder="Naam">
                </div>
                <div class="relative">
                    <input id="email" name="email" type="email" autocomplete="email" required
                           class="mt-1 block w-full shadow-sm border {{ $errors->has('email') ? 'border-red-600' : 'border-gray-300' }} rounded-md pl-3"
                           value="{{ old('email') }}" placeholder="E-mailadres">

                    @if ($errors->has('email'))
                        <p class="mt-2 text-sm text-red-600">Dit e-mailadres is al in gebruik.</p>
                    @endif
                </div>
                <div class="relative">
                    <input id="password" name="password" type="password" autocomplete="new-password" required
                           class="mt-1 block w-full shadow-sm border-gray-300 rounded-md pl-3"
                           placeholder="Wachtwoord">
                    @if ($errors->has('password'))
                        <p class="mt-2 text-sm text-red-600">{{ $errors->first('password') }}</p>
                    @endif
                </div>
                <div class="relative">
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                           class="mt-1 block w-full shadow-sm border-gray-300 rounded-md pl-3"
                           placeholder="Bevestig Wachtwoord">

                    @if ($errors->has('password'))
                        <p class="mt-2 text-sm text-red-600">{{ $errors->first('password') }}</p>
                    @endif
                </div>
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="flex items-center">
                        <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-900">
                            Ik ga akkoord met de <a target="_blank" href="{{ route('terms.show') }}" class="underline">Algemene voorwaarden</a> en <a target="_blank" href="{{ route('policy.show') }}" class="underline">Privacybeleid</a>
                        </label>
                    </div>
                @endif
                <div>
                    <button type="submit" class="w-full flex justify-center uppercase py-2 px-4 border border-transparent rounded-md shadow-sm text-md font-medium text-black button">
                        Registreren
                    </button>
                </div>
            </form>
            <div class="mt-6 text-center text-md">
                <span class="text-gray-600">Heb je al een account?</span>
                <a href="{{ route('login') }}" class="font-medium ml-2" style="color: #d87d4a">Inloggen</a>
            </div>
        </div>
    </div>
</x-guest-layout>
