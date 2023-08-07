<style>
    /* Custom scrollbar styles */
    .navbar-content::-webkit-scrollbar {
        width: 8px;
    }

    .navbar-content::-webkit-scrollbar-track {
        background: rgb(17 24 39);
    }

    .navbar-content::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    .navbar-content::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>

<div class="text-center flex flex-col justify-start h-screen">
    <h1 class="font-bold text-3xl text-center mt-4">Sus&Mus</h1>
    {{-- avatar --}}
    <div class="mt-12 mb-12">
        <img class="rounded-full h-32 w-32 object-cover mx-auto"
             src="{{ $avatar }}"
             alt="{{ auth()->user()->name }}">
        <p>{{ auth()->user()->name }}</p>
    </div>

    <div class="h-full overflow-hidden">
        <div class="max-h-full overflow-y-auto navbar-content">
            <nav class="mt-6">
                <h3 class="text-left px-10 font-bold text-lg">MENU</h3>
                <ul>
                    <li class="py-1 px-4">
                        <a href="{{ route('dashboard') }}"
                           class="text-left text-gray-400 hover:text-white hover:bg-gray-800 px-6 py-3 rounded-lg transition duration-300 ease-in-out block {{ Request::routeIs('dashboard') ? 'bg-gray-800 text-white' : '' }}">
                            <div class="flex gap-4 items-center">
                                <div>
                                    <i class="fa-solid fa-house"></i>
                                </div>
                                <div>
                                    Dashboard
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="py-1 px-4">
                        <a href="{{ route('gebruikers') }}"
                           class="text-left text-gray-400 hover:text-white hover:bg-gray-800 px-6 py-3 rounded-lg transition duration-300 ease-in-out block {{ Request::routeIs('gebruikers') ? 'bg-gray-800 text-white' : '' }}">
                            <div class="flex gap-4 items-center">
                                <div>
                                    <i class="fas fa-users"></i>
                                </div>
                                <div>
                                    Gebruikers
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="py-1 px-4">
                        <a href="{{ route('bestellingen') }}"
                           class="text-left text-gray-400 hover:text-white hover:bg-gray-800 px-6 py-3 rounded-lg transition duration-300 ease-in-out block {{ Request::routeIs('bestellingen') ? 'bg-gray-800 text-white' : '' }}">
                            <div class="flex gap-4 items-center">
                                <div>
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div>
                                    Bestellingen
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="py-1 px-4">
                        <a href="{{ route('producten') }}"
                           class="text-left text-gray-400 hover:text-white hover:bg-gray-800 px-6 py-3 rounded-lg transition duration-300 ease-in-out block {{ Request::routeIs('producten') ? 'bg-gray-800 text-white' : '' }}">
                            <div class="flex gap-4 items-center">
                                <div>
                                    <i class="fas fa-box-open"></i>
                                </div>
                                <div>
                                    Producten
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>

                <hr class="mt-8 mb-8 text-gray-700 px-6 mx-auto" style="width: 60%">

                <h3 class="text-left px-10 font-bold text-lg">INSTELLINGEN</h3>

                <ul>
                    <li class="py-1 px-4">
                        <a href="{{ route('dashboard') }}"
                           class="text-left text-gray-400 hover:text-white hover:bg-gray-800 px-6 py-3 rounded-lg transition duration-300 ease-in-out block {{ Request::routeIs('dashboard') ? 'bg-gray-800 text-white' : '' }}">
                            <div class="flex gap-4 items-center">
                                <div>
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div>
                                    Profiel
                                </div>
                            </div>
                        </a>
                    </li>

                    <li class="py-1 px-4">
                        <a href="{{ route('dashboard') }}"
                           class="text-left text-gray-400 hover:text-white hover:bg-gray-800 px-6 py-3 rounded-lg transition duration-300 ease-in-out block {{ Request::routeIs('dashboard') ? 'bg-gray-800 text-white' : '' }}">
                            <div class="flex gap-4 items-center">
                                <div>
                                    <i class="fa-solid fa-phone-volume"></i>
                                </div>
                                <div>
                                    Help Center
                                </div>
                            </div>
                        </a>
                    </li>

                    <li class="py-1 px-4">
                        <a href="{{ route('dashboard') }}"
                           class="text-left text-gray-400 hover:text-white hover:bg-gray-800 px-6 py-3 rounded-lg transition duration-300 ease-in-out block {{ Request::routeIs('dashboard') ? 'bg-gray-800 text-white' : '' }}">
                            <div class="flex gap-4 items-center">
                                <div>
                                    <i class="fa-solid fa-gear"></i>
                                </div>
                                <div>
                                    Instellingen
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>

                <hr class="mt-8 mb-8 text-gray-700 px-6 mx-auto" style="width: 60%">

                <ul>
                    <li class="py-1 px-4">
                        <a href="{{ route('homepage') }}"
                           class="text-left text-gray-400 hover:text-white hover:bg-gray-800 px-6 py-3 rounded-lg transition duration-300 ease-in-out block">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Verlaten
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

</div>
