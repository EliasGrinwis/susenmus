<div>
    {{-- show preloader while fetching data in the background --}}
    <div class="preloader" wire:loading.class="active">
        <div class="preloader-inner"></div>
    </div>

    {{-- Title --}}
    <h1 class="text-3xl font-bold mb-6">Overzicht bestellingen</h1>
    <div>
        {{-- FILTERS --}}
        <div class="flex py-3">
            <div class="w-1/6">
                <div class="relative">
                    <x-input id="filterOrderNumber" wire:model.lazy="filterOrderNumber" type="text" class="w-full py-2 pr-10 pl-4 rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Zoek op bestelnummer" wire:keydown.enter="render" />
                    <span class="absolute right-3 top-2/4 transform -translate-y-2/4 text-gray-500">
                    <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
            <div class="w-1/3 px-6">
                <div class="relative">
                    <x-input id="filterName" wire:model.lazy="filterName" type="text" class="w-full py-2 pr-10 pl-4 rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Zoek op naam" wire:keydown.enter="render" />
                    <span class="absolute right-3 top-2/4 transform -translate-y-2/4 text-gray-500">
                    <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
            <div class="w-1/3">
                <x-form.select id="filterStatus" wire:model.lazy="filterStatus"
                               class="w-full py-2 pr-10 pl-4 rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Alle statussen</option>
                    <option value="in_afwachting">In afwachting</option>
                    <option value="voltooid">Voltooid</option>
                </x-form.select>
            </div>
        </div>

        <table class="min-w-full bg-white table-auto">
            <thead>
            <tr>
                <th class="py-3 px-6 border-b text-left w-1/6">Bestelnummer</th>
                <th class="py-3 px-6 border-b text-left w-1/3">Naam</th>
                <th class="py-3 px-6 border-b text-left w-1/4">Besteldatum</th>
                <th class="py-3 px-6 border-b text-left w-1/4">Status</th>
                <th class="py-3 px-6 border-b text-left w-1/4"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
                <tr wire:key="{{$order->id}}">
                    <td class="py-4 px-6 border-b">{{$order->id}}</td>
                    <td class="py-4 px-6 border-b">{{$order->user->name}}</td>
                    <td class="py-4 px-6 border-b">{{ date('d/m/Y', strtotime($order->order_date)) }}</td>
                    <td class="py-4 px-6 border-b">
                        <span class="px-2 py-1 rounded font-semibold
                        @if($order->status->name === 'In afwachting') bg-yellow-400 text-yellow-900
                        @elseif($order->status->name === 'Voltooid') bg-green-400 text-green-900
                        @endif">
                            {{ $order->status->name }}
                        </span>
                    </td>
                    <td class="py-4 px-6 border-b relative" x-data="{ open: false }">
                        <i class="fa-solid fa-ellipsis-vertical text-2xl cursor-pointer" @click="open = !open"></i>
                        <div x-show="open" @click.away="open = false"
                             class="absolute bg-gray-100 shadow-lg rounded py-2 mt-2 origin-top-right right-0 transform w-48 rounded-md"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-2">
                            <!-- Dropdown content goes here -->
                            <a wire:click="openOrder({{ $order->id }})"
                               class="block px-4 py-2 hover:bg-gray-200 cursor-pointer">
                                Bekijk bestelling
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-4 font-bold text-center">Er zijn geen bestellingen gevonden!</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="my-4">{{ $orders->links() }}</div>
    </div>

    {{-- HERE WE SHOW THE MODAL TO SHOW THE ORDER --}}
    @isset($orderFromUser)
        <x-dialog-modal id="userModal" wire:model="showModal" class="w-full">
            <x-slot name="title">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold">Bestellingsoverzicht</h2>
                    <button @click="show = false" class="text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </x-slot>

            <x-slot name="content">
                <div class="p-6">
                    {{-- Order details --}}
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Bestelling van:</h3>
                        <p class="text-gray-600">{{ $orderFromUser->user->name }}</p>
                    </div>

                    {{-- Producten --}}
                    @foreach ($orderFromUser->order_lines as $orderLine)
                        <div class="bg-gray-200 rounded-lg p-4 flex items-center space-x-4">
                            <img src="https://via.placeholder.com/100" alt="Product 1" class="w-16 h-16 rounded-full">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">{{ $orderLine->product->name }}</h3>
                                <p class="text-gray-600">Prijs: € {{ $orderLine->product->price }}</p>
                                <p class="text-gray-600">Aantal: {{ $orderLine->amount }}</p>
                            </div>
                        </div>
                    @endforeach

                    {{-- Total price --}}
                    <div class="flex justify-end mt-6">
                        <div class="rounded-lg p-2">
                            {{-- TODO CREATE FUNCTION THAT CALUCLATE TOTAL PRICE --}}
                            <h3 class="text-lg font-semibold">Totale prijs: €35</h3>
                        </div>
                    </div>
                </div>
            </x-slot>

            @if ($orderFromUser->status_id == 1)
                {{-- NOT COMPLETED --}}
                <x-slot name="footer">
                    <x-button wire:click="updateOrder({{ $orderFromUser->id }})" wire:loading.attr="disabled"
                              class="bg-gray-900 hover:bg-gray-700 text-white">
                        Bevestig bestelling
                    </x-button>
                </x-slot>
            @else
                {{-- COMPLETED --}}
                <x-slot name="footer">
                </x-slot>
            @endif
        </x-dialog-modal>
    @endisset
</div>
