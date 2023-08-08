<div>
    <!-- Favorite Products -->
    <div class="container mx-auto px-6">
        <h1 class="text-3xl font-bold py-8">Mijn verlanglijstje</h1>
        <hr>
        <div class="py-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Generate favorite product cards dynamically -->
            <div class="favorite-product-card bg-white rounded-lg overflow-hidden shadow-md w-80">
                <div class="product-image">
                    <img src="http://susenmus.test/storage/products/64cfa86da5ca9.jpg" alt="Product Image" class="w-full h-60 object-cover cursor-pointer">
                </div>
                <div class="product-info p-4">
                    <h2 class="text-lg font-semibold mb-2">Product Name</h2>
                    <p class="text-gray-600">Product Category</p>
                    <div class="flex justify-between items-center mt-4">
                        <p class="text-gray-900 font-bold">€ 25.00</p>

                        <button
                            class="remove-favorite-button bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
