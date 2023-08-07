<div>
    <style>
        .image-container {
            position: relative;
            width: 100%;
            height: 120px;
            overflow: hidden;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .image-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .delete-icon {
            position: absolute;
            top: 4px;
            right: 4px;
            background-color: #ffffff;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
    </style>

    {{-- show preloader while fetching data in the background --}}
    <div class="preloader" wire:loading.class="active">
        <div class="preloader-inner"></div>
    </div>

    {{-- Title --}}
    <h1 class="text-3xl font-bold mb-6">Overzicht producten</h1>
    <div>
        {{-- FILTERS --}}
        <div class="flex justify-between py-5">
            <div class="w-1/3">
                <div class="relative">
                    <x-input id="filterName" wire:model.lazy="filterName" type="text"
                             class="w-full py-2 pr-10 pl-4 rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                             placeholder="Zoek op naam" wire:keydown.enter="render"/>
                    <span class="absolute right-3 top-2/4 transform -translate-y-2/4 text-gray-500">
                    <i class="fas fa-search"></i>
                    </span>
                </div>
            </div>

            <!-- Modal toggle -->
            <button wire:click="openModal()"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                Nieuw product
            </button>
        </div>

        <table class="min-w-full bg-white table-auto">
            <thead>
            <tr>
                <th class="py-3 px-6 border-b text-left w-1/6">Naam</th>
                <th class="py-3 px-6 border-b text-left w-1/6">Prijs</th>
                <th class="py-3 px-6 border-b text-left w-1/4">Beschikbare maten (aantal)</th>
                <th class="py-3 px-6 border-b text-left w-1/6">Category</th>
                <th class="py-3 px-6 border-b text-left w-1/6">Acties</th>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $product)
                <tr wire:key="{{$product->id}}">
                    <td class="py-4 px-6 border-b">{{$product->name}}</td>
                    <td class="py-4 px-6 border-b">€ {{$product->price}}</td>
                    <td class="py-4 px-6 border-b">
                        @if($product->product_sizes->count() == 0)
                            <span>Dit product heeft geen maat</span>
                        @else
                            <x-form.select class="w-1/2">
                                @foreach($product->product_sizes as $product_size)
                                    <option>{{$product_size->size->name}} ({{$product_size->max_quantity_available}})
                                    </option>
                                @endforeach
                            </x-form.select>
                        @endif
                    </td>
                    <td class="py-4 px-6 border-b">{{$product->category->name}}</td>
                    <td class="py-4 px-6 border-b"></td>

                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-4 font-bold text-center">Er zijn geen producten gevonden!</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="my-4">{{ $products->links() }}</div>
    </div>

    {{-- HERE WE SHOW THE MODAL TO ADD A PRODUCT --}}
    <x-dialog-modal id="productModal" wire:model="showModal" class="w-72">
        <x-slot name="title">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Product toevoegen
                </h3>
                <button @click="show = false" type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                <div>
                    <label for="name" class="block mb-2 text-lg font-medium text-black">Naam</label>
                    <input wire:model.defer="newProduct.name" type="text" name="name" id="name"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                           placeholder="Type product naam" required="">
                </div>
                <div>
                    <label for="price" class="block mb-2 text-lg font-medium text-black">Prijs (€)</label>
                    <input wire:model.defer="newProduct.price" type="number" name="price" id="price"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                           placeholder="€ 19.99" required="">
                </div>
                <div>
                    <label for="category" class="block mb-2 text-lg font-medium text-black">Categorie</label>
                    <select wire:model.defer="newProduct.category_id" id="category"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="" style="color: gray;">Selecteer een categorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="sm:col-span-2 mb-4 w-full">
                    <h2 class="mb-2 text-lg font-medium text-black">Maten (optioneel)</h2>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($sizes as $size)
                            <div class="flex items-center">
                                <input id="size_{{ $size->id }}" type="checkbox" value="{{ $size->id }}"
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                       wire:model.defer="selectedSizesWithQuantity.{{ $size->id }}.size">
                                <label for="size_{{ $size->id }}"
                                       class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $size->name }}</label>
                            </div>
                            <div class="flex items-center">
                                <label for="quantity_{{ $size->id }}"
                                       class="text-sm font-medium text-gray-900 dark:text-gray-300">Hoeveelheid:</label>
                                <input type="number" id="quantity_{{ $size->id }}" name="quantity_{{ $size->id }}"
                                       min="0" value="0"
                                       class="ml-2 w-16 px-2 py-1 text-sm text-gray-900 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                       disabled
                                       wire:model.defer="selectedSizesWithQuantity.{{ $size->id }}.quantity">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="sm:col-span-2 mb-4 w-full">
{{--                    <div class="grid grid-cols-2 gap-4">--}}
{{--                        <div class="flex items-center">--}}
{{--                            <label class="relative inline-flex items-center cursor-pointer">--}}
{{--                                <input wire:model.defer="newProduct.TU" id="tuCheckbox" type="checkbox" value="" class="sr-only peer">--}}
{{--                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>--}}
{{--                                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">TU</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="flex items-center">--}}
{{--                            <label for="quantity" class="text-sm font-medium text-gray-900 dark:text-gray-300">Hoeveelheid:</label>--}}
{{--                            <input type="number" id="quantity" name="quantity" min="0" value="0"--}}
{{--                                   class="ml-2 w-16 px-2 py-1 text-sm text-gray-900 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"--}}
{{--                                   disabled wire:model.defer="newProduct.quantity">--}}
{{--                        </div>--}}
{{--                    </div>--}}


                    <div class="sm:col-span-2 mt-4">
                        <p class="mb-2 text-lg font-medium text-black">Product foto(s)</p>

                        <div class="grid grid-cols-2 gap-4">
                            {{-- SHOW MULTIPLE IMAGES THAT YOU UPLOAD --}}
                            @foreach($images as $image)
                                <div class="image-container">
                                    <img class="image-preview" src="/storage/{{ $image }}" alt="{{ $image }}">
                                    <div class="delete-icon" wire:click="removeImage('{{ $image }}')">
                                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex items-center justify-center w-full mt-4">
                            <label for="dropzone-file"
                                   class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-100 dark:hover:bg-gray-600 hover:bg-gray-200 dark:border-gray-500 dark:hover:border-gray-400">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Klik om te uploaden</span>
                                        of sleep en zet neer</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG of GIF (MAX. 800x400px)</p>
                                </div>
                                <input wire:model="images" id="dropzone-file" type="file" class="hidden" name="images[]"
                                       accept="image/*" multiple/>
                            </label>
                        </div>

                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <button wire:click="createProduct" type="submit"
                    class="text-white bg-black inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                          clip-rule="evenodd"></path>
                </svg>
                Product toevoegen
            </button>
        </x-slot>
    </x-dialog-modal>


</div>

<script>
    // Function to enable/disable the quantity input field based on the checkbox state
    function toggleQuantityInput(checkboxId, inputId) {
        const checkbox = document.getElementById(checkboxId);
        const input = document.getElementById(inputId);
        input.disabled = !checkbox.checked;
        if (!checkbox.checked) {
            input.value = 0; // Reset quantity to 0 when checkbox is unchecked
        }
    }

    // const tuCheckbox = document.getElementById('tuCheckbox');
    // const quantityInput = document.getElementById('quantity');
    // quantityInput.disabled = !tuCheckbox.checked;
    //
    // tuCheckbox.addEventListener('change', function () {
    //     quantityInput.disabled = !tuCheckbox.checked;
    //     if (!tuCheckbox.checked) {
    //         quantityInput.value = 0;
    //     }
    // });

    // Add event listeners to each checkbox to toggle the corresponding quantity input field
    @foreach($sizes as $size)
    document.getElementById('size_{{ $size->id }}').addEventListener('change', function () {
        toggleQuantityInput('size_{{ $size->id }}', 'quantity_{{ $size->id }}');
    });
    @endforeach

</script>
