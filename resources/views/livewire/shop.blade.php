<div>
    <style>
        .selected {
            border: 2px solid #d87d4a;
        }

        .zoom {
            overflow: hidden;
            cursor: zoom-in;
        }

        .zoom img:hover {
            opacity: 0;
        }

        .zoom img {
            transition: opacity .5s;
            display: block;
            width: 100%;
        }

    </style>

    <div class="container mx-auto py-10 px-4 lg:px-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="relative w-full md:w-7/12">
                <x-input id="filterProductName" wire:model.lazy="filterProductName" type="text"
                         class="w-full py-2 pr-10 pl-4 rounded-lg bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                         placeholder="Waar ben je naar op zoek?" wire:keydown.enter="render"/>
                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                <i class="fas fa-search"></i>
            </span>
            </div>
            <div class="w-full md:w-1/4 mt-4 md:mt-0">
                <label>
                    <select class="w-full p-2 rounded-lg bg-gray-200" placeholder="Sorteren" wire:model="sortBy">
                        <option value="">Populariteit</option>
                        <option value="low_to_high">Prijs laag - hoog</option>
                        <option value="high_to_low">Prijs hoog - laag</option>
                    </select>
                </label>
            </div>
        </div>
    </div>


    <div class="container mx-auto grid grid-cols-1 lg:grid-cols-5 gap-4 px-4 lg:px-6 mb-20">
        <div class="col-span-1">
            <div class="mb-4">
                <div>
                    <h2>
                        <button type="button"
                                wire:click="toggleFilterSection"
                                class="bg-white flex items-center justify-between w-full py-2 font-bold border-b border-gray-300 text-left text-black"
                                aria-expanded="{{ $expand ? 'true' : 'false' }}">
                            <span class="text-xl">Categorieën</span>
                            <svg data-accordion-icon
                                 class="w-3 h-3 {{ $expand ? 'rotate-180' : 'rotate-360'  }} shrink-0"
                                 aria-hidden="false"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M9 5 5 1 1 5"/>
                            </svg>
                        </button>
                    </h2>
                    <div class="{{ $expand ? '' : 'hidden' }}">
                        <div class="my-2">
                            @foreach ($categories as $category)
                                <div class="my-2">
                                    <input wire:model="filterSelectedCategories" id="{{ $category->name }}" value="{{ $category->id }}" name="categories[]" type="checkbox" class="w-6 h-6">
                                    <label for="{{ $category->name }}">{{ $category->name }}</label>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h2>
                    <button type="button"
                            wire:click="togglePriceFilterSection"
                            class="bg-white flex items-center justify-between w-full py-2 font-bold border-b border-gray-300 text-left text-black"
                            aria-expanded="{{ $priceExpand ? 'true' : 'false' }}">
                        <span class="text-xl">Prijs (€)</span>
                        <svg data-accordion-icon
                             class="w-3 h-3 {{ $priceExpand ? 'rotate-180' : 'rotate-360'  }} shrink-0"
                             aria-hidden="false"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div class="{{ $priceExpand ? '' : 'hidden' }}">
                    <div class="my-2">
                        <div class="my-2">
                            <label for="price-range">Prijs &le;
                                <output id="priceFilter" name="priceFilter">{{ $price }}</output>
                            </label>
                            <input id="price-range" name="price-range" type="range" min="{{ $minPrice }}"
                                   max="{{ $maxPrice }}" step="1" class="w-full" wire:model="price">
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h2>
                    <button type="button"
                            wire:click="toggleSizeFilterSection"
                            class="bg-white flex items-center justify-between w-full py-2 font-bold border-b border-gray-300 text-left text-black"
                            aria-expanded="{{ $sizeExpand ? 'true' : 'false' }}">
                        <span class="text-xl">Maten</span>
                        <svg data-accordion-icon
                             class="w-3 h-3 {{ $sizeExpand ? 'rotate-180' : 'rotate-360'  }} shrink-0"
                             aria-hidden="false"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div class="{{ $sizeExpand ? '' : 'hidden' }}">
                    <div class="my-2 flex flex-wrap gap-4">
                        @foreach ($sizes as $size)
                            <button wire:click="filterSize({{ $size->id }})"
                                    class="{{ in_array($size->id, $filterSelectedSizes) ? 'selected' : '' }} border border-gray-300 rounded-md cursor-pointer p-2">{{ $size->name }}</button>
                        @endforeach

                    </div>
                </div>
            </div>


        </div>


        <div class="col-span-1 lg:col-span-4">
            <!-- PRODUCT CARTS -->
            @forelse($products as $product)
                <div class="mt-8" wire:key="product_{{$product->id}}">
                    <div class="product-card  bg-white rounded-lg overflow-hidden shadow-md flex" style="height: 260px">
                        <div class="w-2/5 relative">
                            <img src="/storage/{{ $product->images[0]->image_path }}" alt="Product Afbeelding 1"
                                 class="w-full h-full object-cover rounded-tl-lg rounded-bl-lg" loading="lazy">
                            <div class="absolute top-2 right-2">
                                <button class="relative p-2 rounded-xl bg-black">
                                    <svg class="heart-icon" width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M12 6.00019C10.2006 3.90317 7.19377 3.2551 4.93923 5.17534C2.68468 7.09558 2.36727 10.3061 4.13778 12.5772C5.60984 14.4654 10.0648 18.4479 11.5249 19.7369C11.6882 19.8811 11.7699 19.9532 11.8652 19.9815C11.9483 20.0062 12.0393 20.0062 12.1225 19.9815C12.2178 19.9532 12.2994 19.8811 12.4628 19.7369C13.9229 18.4479 18.3778 14.4654 19.8499 12.5772C21.6204 10.3061 21.3417 7.07538 19.0484 5.17534C16.7551 3.2753 13.7994 3.90317 12 6.00019Z"
                                              stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>
                                </button>

                                <style>
                                    .heart-icon:hover {
                                        fill: white;
                                    }
                                </style>

                            </div>
                            <div class="absolute bottom-2 left-2 bg-black rounded-full px-2 py-1">
                                <span class="text-sm font-semibold text-white">Op voorraad</span>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col justify-between w-3/5">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h2>
                                <p class="text-sm text-gray-600 mb-4">Categorie: {{ $product->category->name }}</p>
                                <span class="text-2xl font-bold text-gray-900">€ {{ $product->price }}</span>
                                {{--                                <div>--}}
                                {{--                                    <span class="text-xl font-medium text-gray-500 line-through">€ {{ $product->price }}</span>--}}
                                {{--                                    <span class="text-2xl font-bold text-black ml-2">€ {{ $product->price }}</span>--}}
                                {{--                                </div>--}}
                            </div>
                            <div class="flex mt-2">
                                <!-- All sizes as separate blocks -->
                                @foreach($product->product_sizes as $size)
                                    <button
                                        wire:click.prevent="updateSize({{ $size->size }}, {{ $product }}, {{ $size }})"
                                        onclick="selectSize({{ $size->size->id }}, {{ $size->product_id }})"
                                        id="{{$size->size->id}}"
                                        class="all-product-sizes product-sizes-{{ $size->product_id }} w-12 h-12 flex items-center justify-center border border-gray-300 rounded-md cursor-pointer mr-4 size-option @if($selectedSize == $size->id) selected @endif">
                                        <span>{{ $size->size->abbreviation }}</span>
                                    </button>
                                @endforeach

                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <button
                                    wire:click="createOrder({{ $product }})"
                                    class="flex items-center gap-4 bg-primary hover:bg-primary_hover text-white font-semibold py-3 px-6 rounded-full shadow-md focus:outline-none focus:shadow-outline">
                                    <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1"/>
                                    </svg>
                                    Toevoegen aan Winkelwagen
                                </button>
                                <button onclick="imageFunction({{ json_encode($product->images) }})"
                                        class="text-blue-500 hover:text-blue-600 focus:outline-none mt-2">
                                    <i class="far fa-images mr-1"></i> Meer Afbeeldingen
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center">
                    <p class="text-lg text-gray-600 mb-4">
                        Geen producten gevonden. Pas je filters aan om nieuwe resultaten te krijgen.
                    </p>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Reset Filters
                    </button>
                </div>

            @endforelse
        </div>
    </div>


    <div id="image-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden ">
        <div class="absolute inset-0 bg-black opacity-50"></div> <!-- Darker background overlay -->
        <div class="relative bg-white rounded-lg p-6 shadow-xl" style="width: 400px">
            <!-- The modal content (main image and smaller images) -->
            <div id="zoom" class="zoom relative w-full rounded-lg overflow-hidden" style="height: 550px;"
                 onmousemove="zoom(event)">
                <img id="modal-main-image" src="" alt="Main Image" class="w-full h-full object-cover shadow-lg">
            </div>
            <div class="small flex items-center justify-between mt-4">
                <!-- Smaller images will be dynamically added here -->
            </div>

            <p class="text-black text-sm text-center mt-4 cursor-pointer underline" onclick="closeModal()">Venster
                sluiten</p>
        </div>
    </div>
</div>

<script>

    function selectSize(productSizeElement, productID) {
        const productSizes = document.querySelectorAll(".product-sizes-" + productID);
        const allProductSizes = document.querySelectorAll('.all-product-sizes');

        allProductSizes.forEach(productSize => {
            productSize.classList.remove("selected");
        })

        productSizes.forEach(size => {
            if (size.id === productSizeElement.toString()) {
                size.classList.add("selected");
            } else {
                size.classList.remove("selected");
            }
        });
    }

    function zoom(e) {
        var zoomer = e.currentTarget;
        e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
        e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
        x = offsetX / zoomer.offsetWidth * 100
        y = offsetY / zoomer.offsetHeight * 100
        zoomer.style.backgroundPosition = x + '% ' + y + '%';
    }


    function imageFunction(productImages) {
        // productImages is an array of images

        const modalMainImage = document.getElementById("modal-main-image");
        const smallerImagesContainer = document.querySelector("#image-modal .small");

        // Clear the previous content in the smaller images container.
        smallerImagesContainer.innerHTML = "";

        const zoom = document.getElementById('zoom');

        // Display the main image in the modal.
        modalMainImage.src = '/storage/' + productImages[0].image_path;
        modalMainImage.alt = productImages[0].name;

        zoom.style.backgroundImage = `url(${modalMainImage.src})`;

        function selectImage(imgElement) {
            const allImages = smallerImagesContainer.querySelectorAll("img");
            allImages.forEach(image => {
                if (image === imgElement) {
                    image.classList.add("selected");
                } else {
                    image.classList.remove("selected");
                }
            });
        }


        // Append smaller images to the modal.
        productImages.forEach(image => {
            const imgElement = document.createElement("img");
            imgElement.src = '/storage/' + image.image_path;
            imgElement.alt = image.name;
            imgElement.classList.add("cursor-pointer", "object-cover", "w-20", "h-20", "rounded-lg", "shadow-md");

            imgElement.addEventListener('click', function () {
                modalMainImage.src = this.src;
                modalMainImage.alt = this.alt;
                zoom.style.backgroundImage = `url(${modalMainImage.src})`;

                selectImage(this); // Call the selectImage function to apply the highlight
            });

            smallerImagesContainer.appendChild(imgElement);
        });

        const selectedImage = smallerImagesContainer.querySelector(".selected");
        if (!selectedImage) {
            const firstImage = smallerImagesContainer.querySelector("img");
            if (firstImage) {
                selectImage(firstImage);
            }
        }

        // Show the modal.
        const imageModal = document.getElementById("image-modal");
        imageModal.classList.remove("hidden");
    }

    function closeModal() {
        const imageModal = document.getElementById("image-modal");
        imageModal.classList.add("hidden");
    }

</script>
