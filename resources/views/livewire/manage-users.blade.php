<div>
    {{-- show preloader while fetching data in the background --}}
    <div class="preloader" wire:loading.class="active">
        <div class="preloader-inner"></div>
    </div>

    {{-- Title --}}
    <h1 class="text-3xl font-bold mb-6">Overzicht gebruikers</h1>
    <div>
        {{-- FILTER --}}
        <div class="flex py-3">
            <div class="w-1/3">
                <div class="relative">
                    <x-input id="filterName" wire:model.lazy="filterName" type="text" class="w-full py-2 pr-10 pl-4 rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Zoek op naam" wire:keydown.enter="render" />
                    <span class="absolute right-3 top-2/4 transform -translate-y-2/4 text-gray-500">
                    <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>
        </div>

        <table class="min-w-full bg-white table-auto">
            <thead>
            <tr>
                <th class="py-3 px-6 border-b text-left w-1/4">Naam</th>
                <th class="py-3 px-6 border-b text-left w-1/4">Email</th>
                <th class="py-3 px-6 border-b text-left w-1/4">Rol</th>
                <th class="py-3 px-6 border-b text-left w-1/4">Acties</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr wire:key="{{$user->id}}">
                    <td class="py-4 px-6 border-b">{{$user->name}}</td>
                    <td class="py-4 px-6 border-b">{{$user->email}}</td>
                    <td class="py-4 px-6 border-b">{{$user->role->name}}</td>
                    <td x-data="" class="py-4 px-6 border-b">
                        <button wire:click="editUser({{ $user->id }})" style="background: #558cf5" wire:loading.attr="disabled" class="text-white py-2 px-4 rounded">
                            Bewerken
                        </button>
                        <button
                            @click="$dispatch('swal:confirm', {
                                title: 'Verwijder de gebruiker?',
                                cancelButtonText: 'NEE!',
                                confirmButtonText: 'JA, VERWIJDER DE GEBRUIKER',
                                next: {
                                    event: 'delete-user',
                                    params: {
                                        id: {{ $user->id }}
                                        }
                                    }
                            });"
                            class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded ml-2">
                            Verwijderen
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-4 font-bold text-center">Er zijn geen gebruikers gevonden!</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="my-4">{{ $users->links() }}</div>
    </div>

    {{-- HERE WE SHOW THE MODAL TO EDIT THE USER --}}
    <x-dialog-modal id="userModal" wire:model="showModal" class="w-72">
        <x-slot name="title">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-bold">Bewerk Gebruiker</h2>
                <button @click="show = false" class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </x-slot>

        <x-slot name="content">
            @if ($errors->any())
                <div class="bg-red-500 text-white rounded p-4 mb-4">
                    <ul class="list-disc ml-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex items-center mb-8">
                <div>
                    <img src="{{ $editUser['profile_image'] }}" alt="{{ $editUser['name'] }}" class="h-20 w-20 object-cover rounded-full mx-auto">
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-bold">{{ $editUser['name'] }}</h2>
                    <p class="text-gray-500">{{ $editUser['email'] }}</p>
                </div>
            </div>

            <div class="mt-4">
                <x-label for="name" value="Naam" class="text-lg font-medium"/>
                <x-input id="name" type="text" wire:model.defer="editUser.name"
                         class="mt-2 p-2 w-full border border-gray-300 rounded"/>
            </div>

            <div class="mt-6">
                <x-label for="email" value="Email" class="text-lg font-medium"/>
                <x-input id="email" type="text" wire:model.defer="editUser.email"
                         class="mt-2 p-2 w-full border border-gray-300 rounded"/>
            </div>

            <div class="mt-6">
                <x-label for="role_id" value="Rol"/>
                <x-form.select wire:model.defer="editUser.role_id" id="role_id" class="block mt-1 w-full">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </x-form.select>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="updateUser({{ $editUser['id'] }})" wire:loading.attr="disabled"
                      class="bg-gray-900 hover:bg-gray-700 text-white">
                Bewerk gebruiker
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
