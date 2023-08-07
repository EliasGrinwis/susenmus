<div>
    <div class="container mx-auto border-b border-grey-800 px-2">
        <div class="flex items-center justify-between h-24 ">
            <a href="{{ route('homepage') }}"><img class="w-36 h-24" src="/logo.png" alt="Logo"/></a>
            <nav class="text-white">
                <ul role="list" class="flex gap-10 text-white">
                    <li class="uppercase font-bold tracking-wide hover:text-orange-500 {{ Request::routeIs('homepage') ? 'text-orange-500' : '' }}">
                        <a href="{{ route('homepage') }}">WELKOM</a></li>
                    <li class="uppercase font-bold tracking-wide hover:text-orange-500 {{ Request::routeIs('shop') ? 'text-orange-500' : '' }}">
                        <a href="{{ route('shop') }}">SHOP</a></li>
                    <li class="uppercase font-bold tracking-wide hover:text-orange-500 {{ Request::routeIs('contact') ? 'text-orange-500' : '' }}">
                        <a href="{{ route('contact') }}">CONTACT</a></li>
                </ul>
            </nav>
            @guest
                <div class="buttons">
                    <a href="{{ route('login') }}" class="uppercase mr-4 text-white hover:text-orange-500">Inloggen</a>
                    <a href="{{ route('register') }}"
                       class="uppercase inline-flex items-center px-3 py-2 border border-transparent  font-medium rounded-md text-white button">Registreren</a>
                </div>
            @endguest
            @auth
                {{-- right navigation --}}
                <div class="relative flex items-center space-x-4">
                    {{-- dropdown navigation--}}
                    <x-dropdown align="right" width="48">
                        {{-- avatar --}}
                        <x-slot name="trigger">
                            <img class="rounded-full h-8 w-8 cursor-pointer"
                                 src="{{ $avatar }}"
                                 alt="Vinyl Shop">
                        </x-slot>
                        <x-slot name="content">
                            {{-- all users --}}
                            <div class="block px-4 py-2 text-xs text-gray-400">{{ Auth::user()->name }}</div>
                            <x-dropdown-link href="{{ route('profile.show') }}"><i class="fa-solid fa-user mr-2"></i>
                                Accountoverzicht
                            </x-dropdown-link>
                            <div class="border-t border-gray-100"></div>
                            <x-dropdown-link href="{{ route('profile.show') }}"><i
                                    class="fa-solid fa-bag-shopping mr-2"></i> Bestellingen
                            </x-dropdown-link>
                            <div class="border-t border-gray-100"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="block w-full px-4 py-2 text-left text-md leading-5 text-gray-700 hover:bg-gray-300 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                    <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Uitloggen
                                </button>
                            </form>
                            <div class="border-t border-gray-100"></div>
                            @if(auth()->user()->role_id === 1)
                                {{-- admins only --}}
                                <div class="block px-4 py-2 text-xs text-gray-400">Administrator</div>
                                <x-dropdown-link href="{{ route('dashboard') }}"><i class="fa-solid fa-house mr-2"></i>
                                    Dashboard
                                </x-dropdown-link>
                            @endif
                        </x-slot>
                    </x-dropdown>

                    <i class="text-xl cursor-pointer fa-solid fa-heart px-2"></i>

                    <div class="relative">
                        @if ($orders !== null && $orders->order_lines->count() > 0)
                            <i id="cart-icon" class="cursor-pointer fa fa-lg fa-shopping-cart relative">
                                <span class="bg-red-500 text-white rounded-full px-2 py-1 text-xs absolute -top-6 -right-4">{{ $orders->order_lines->count() }}</span>
                            </i>
                        @else
                            <i id="cart-icon" class="cursor-pointer fa fa-lg fa-shopping-cart"></i>
                        @endif

                        <div  id="cart-overview"
                             class="{{ $cartOverviewVisible ? '' : 'hidden' }} absolute top-10 right-0 bg-white border border-gray-300 rounded-lg shadow-lg p-8 z-50 h-auto"
                             style="width: 400px">
                            @if ($orders !== null && $orders->order_lines->count() > 0)
                                @foreach($orders->order_lines as $orderLine)

                                        <?php
                                        $price = $orderLine->product->price;
                                        $quantity = $orderLine->amount;
                                        $lineTotal = $quantity * $price;
                                        $totalPrice += $lineTotal;
                                        ?>

                                    <div class="py-3">
                                        <div class="flex items-center">
                                            <img src="{{ $orderLine->image_path }}" alt="Product Image"
                                                 class="w-24 h-24 object-cover rounded"> <!-- Increased image size -->
                                            <div class="flex-1 ml-4">
                                                <div
                                                    class="font-semibold text-xl text-black">{{ $orderLine->product->name }}</div>
                                                <!-- Increased product name size -->
                                                <div class="text-gray-600 text-lg">
                                                    € {{ $orderLine->product->price }}</div>
                                                <!-- Increased price size and used a slightly darker gray -->
                                                <div class="text-gray-500 text-sm">Maat: {{ $orderLine->size }}</div>
                                                <!-- Increased size element size and used a lighter gray -->
                                            </div>
                                            <div class="flex items-center">
                                                <label>
                                                    <select
                                                        wire:key="amount-{{ $orderLine->id }}"
                                                        wire:model="amounts.{{ $orderLine->id }}.amount"
                                                        wire:change="updateQuantity({{ $orderLine }})"
                                                        class="text-gray-500 focus:outline-none border border-gray-300 rounded-sm py-1 px-2 text-lg">
                                                        <!-- Increased select box font size -->
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </label>
                                                <button
                                                    wire:click="deleteOrderLine({{ $orderLine }})" class="text-gray-500 focus:outline-none ml-4 p-1">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="border-gray-300">
                                @endforeach
                                <hr class="border-gray-300">

                                <div class="py-3">
                                    <div class="flex items-center justify-between">
                                        <div class="text-black font-bold text-xl">Totale prijs:</div>
                                        <div id="totalPrice" class="text-black font-bold text-xl">€ {{ $totalPrice }}</div>
                                    </div>
                                </div>

                                <div class="py-3 w-full">
                                    <button
                                        class="text-black bg-primary text-white hover:bg-primary_hover p-3 w-full rounded-lg">
                                        Verder naar bestellen
                                    </button>
                                </div>
                            @else
                                <p class="text-black text-center text-2xl">Je winkelmandje is leeg</p>
                            @endif


                        </div>
                    </div>
                </div>

            @endauth
        </div>

    </div>
</div>


<script>

    const cartIcon = document.getElementById('cart-icon');
    const cartOverview = document.getElementById('cart-overview');

    cartIcon.addEventListener('click', () => {
        cartOverview.classList.toggle('hidden');
    });
</script>
