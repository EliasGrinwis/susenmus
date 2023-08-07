<x-app-layout>
    <div class="container mx-auto grid grid-cols-3 gap-4 px-6 py-10">
        <div>
            <ul>
                <a href="{{ route('profile.show') }}" class="hover:text-orange-500">
                    <li class="h-12 flex items-center gap-4 py-7 {{ Request::routeIs('profile.show') ? 'border-l-4 border-orange-500' : 'border-l-4 border-white' }}">
                        <div>
                            <i class="fa-solid fa-user ml-2 text-2xl"></i>
                        </div>
                        <div>
                            <span class="text-xl">Accountoverzicht</span>
                        </div>
                    </li>
                </a>

                <a href="{{ route('profile.show') }}" class="hover:text-orange-500">
                    <li class="h-12 flex items-center gap-4 py-7 {{ Request::routeIs('dashboard') ? 'border-l-4 border-orange-500' : 'border-l-4 border-white' }}">
                        <div>
                            <i class="fa-solid fa-bag-shopping ml-2 text-2xl"></i>
                        </div>
                        <div>
                            <span class="text-xl">Bestellingen</span>
                        </div>
                    </li>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="hover:text-orange-500 cursor-pointer w-full">
                        <li class="h-12 flex items-center gap-4 py-7 {{ Request::routeIs('dashboard') ? 'border-l-4 border-orange-500' : 'border-l-4 border-white' }}">
                            <div>
                                <i class="fa-solid fa-arrow-right-from-bracket ml-2 text-2xl"></i>
                            </div>
                            <div>
                                <span class="text-xl">Uitloggen</span>
                            </div>
                        </li>
                    </button>
                </form>
            </ul>
        </div>
        <div class="col-span-2">
            <h1 class="text-4xl font-bold">Accountoverzicht</h1>
            <div class="mt-7 py-12 px-4 flex justify-between items-center" style="background-color: #f1f1f1">
                <div>
                    <span class="text-4xl font-bold">Hallo {{auth()->user()->name}}, <br></span>
                    <span class="text-2xl">hier vind je al je relevante informatie</span>
                </div>
                <div>
                    @php
                        $user = auth()->user();
                        $avatar = 'https://ui-avatars.com/api/?name=' . urlencode($user->name);

                        if ($user->profile_photo_path) {
                            $avatar = asset('storage/' . $user->profile_photo_path);
                        }
                    @endphp
                    <img class="rounded-full w-20 h-20" src="{{ $avatar }}" alt="avatar">
                </div>

            </div>

            <!-- User Information Block -->
            <div class="mt-8 px-4 py-6 bg-white rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-4">Profielgegevens</h2>
                <div class="flex flex-wrap">
                    <div class="w-full md:w-1/2 lg:w-1/3 pr-4 mb-4">
                        <label for="name" class="block font-semibold mb-2">Naam</label>
                        <p>{{ auth()->user()->name }}</p>
                    </div>
                    <div class="w-full md:w-1/2 lg:w-1/3 pr-4 mb-4">
                        <label for="email" class="block font-semibold mb-2">E-mail</label>
                        <p>{{ auth()->user()->email }}</p>
                    </div>
                    <div class="w-full md:w-1/2 lg:w-1/3 pr-4 mb-4">
                        <label for="klantnummer" class="block font-semibold mb-2">Klantnummer</label>
                        <p>{{ auth()->user()->customer_number }}</p>
                    </div>
                    <div class="w-full md:w-1/2 lg:w-1/3 pr-4 mb-4">
                        <label for="bezorgadres" class="block font-semibold mb-2">Bezorgadres</label>
                        <p>{{ auth()->user()->name }}</p>
                    </div>
                    <div class="w-full md:w-1/2 lg:w-1/3 pr-4 mb-4">
                        <label for="profile_photo" class="block font-semibold mb-2">Profielafbeelding</label>
                        <img class="rounded-full w-20 h-20" src="{{ $avatar }}" alt="avatar">
                    </div>
                    <div class="w-full">
                        <button id="editProfileButton" class="bg-orange-500 text-white py-2 px-4 rounded-lg hover:bg-orange-600">Profiel bewerken</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal for Profile Update -->
    <div id="profileModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">Profielgegevens aanpassen</h2>
            <form  method="POST" action="{{ route('user-profile-information.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-gray-700 font-semibold mb-2">Naam</label>
                        <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" class="border rounded-lg px-3 py-2 w-full">
                    </div>

                    <div>
                        <label for="email" class="block text-gray-700 font-semibold mb-2">E-mail</label>
                        <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="border rounded-lg px-3 py-2 w-full">
                    </div>

                    <div>
                        <label for="klantnummer" class="block text-gray-700 font-semibold mb-2">Klantnummer</label>
                        <input type="text" name="klantnummer" id="klantnummer" value="{{ auth()->user()->name }}" class="border rounded-lg px-3 py-2 w-full">
                    </div>

                    <div>
                        <label for="bezorgadres" class="block text-gray-700 font-semibold mb-2">Bezorgadres</label>
                        <input type="text" name="bezorgadres" id="bezorgadres" value="{{ auth()->user()->name }}" class="border rounded-lg px-3 py-2 w-full">
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-orange-500 text-white py-2 px-4 rounded-lg hover:bg-orange-600">Opslaan</button>
                    <button id="closeModalButton" class="ml-4 text-gray-500 hover:text-gray-700">Annuleren</button>
                </div>
            </form>
        </div>
    </div>


    <!-- JavaScript to handle the modal -->
    <script>
        const editProfileButton = document.getElementById('editProfileButton');
        const profileModal = document.getElementById('profileModal');
        const closeModalButton = document.getElementById('closeModalButton');

        // Function to open the modal
        function openModal() {
            profileModal.classList.remove('hidden');
        }

        // Function to close the modal
        function closeModal() {
            profileModal.classList.add('hidden');
        }

        // Event listeners
        editProfileButton.addEventListener('click', openModal);
        closeModalButton.addEventListener('click', closeModal);
    </script>


{{--    <div>--}}
{{--        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">--}}
{{--            @if (Laravel\Fortify\Features::canUpdateProfileInformation())--}}
{{--                @livewire('profile.update-profile-information-form')--}}

{{--                <x-section-border/>--}}
{{--            @endif--}}

{{--            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))--}}
{{--                <div class="mt-10 sm:mt-0">--}}
{{--                    @livewire('profile.update-password-form')--}}
{{--                </div>--}}

{{--                <x-section-border/>--}}
{{--            @endif--}}

{{--            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())--}}
{{--                <div class="mt-10 sm:mt-0">--}}
{{--                    @livewire('profile.two-factor-authentication-form')--}}
{{--                </div>--}}

{{--                <x-section-border/>--}}
{{--            @endif--}}

{{--            <div class="mt-10 sm:mt-0">--}}
{{--                @livewire('profile.logout-other-browser-sessions-form')--}}
{{--            </div>--}}

{{--            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())--}}
{{--                <x-section-border/>--}}

{{--                <div class="mt-10 sm:mt-0">--}}
{{--                    @livewire('profile.delete-user-form')--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </div>--}}
</x-app-layout>
