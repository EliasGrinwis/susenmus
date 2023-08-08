<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Size;
use Auth;
use Livewire\Component;

class Shop extends Component
{
    // Define public properties for size, selected size, product image, and selected size flag
    public $sizeName;
    public $selectedSize;
    public $productImage;
    public $selectedSizeFound = false;

    public $expand = true;
    public $priceExpand = true;
    public $sizeExpand = true;

    public $price;
    public $minPrice;
    public $maxPrice;

    public $filterSelectedSizes = [];
    public $filterSelectedCategories = [];

    public $sortBy = '';

    public $filterProductName;

    public function toggleFilterSection()
    {
        $this->expand = !$this->expand;
    }

    public function togglePriceFilterSection()
    {
        $this->priceExpand = !$this->priceExpand;
    }

    public function toggleSizeFilterSection()
    {
        $this->sizeExpand = !$this->sizeExpand;
    }

    // Method to update the selected size, product image, and size name
    public function updateSize(Size $size, Product $product, ProductSize $productSize)
    {
        // Set the selected size, product image, and size name based on the provided parameters
        $this->selectedSize = $productSize->id;
        $this->productImage = '/storage/' . $product->images[0]->image_path;
        $this->sizeName = $size->name;
    }

    // Method to create an order for a product
    public function createOrder(Product $product)
    {
        // Check if the selected size is available for the product
        foreach ($product->product_sizes as $productSize) {
            if ($productSize->id === $this->selectedSize) {
                $this->selectedSizeFound = true;
            }
        }

        // If the selected size is available, proceed to create the order
        if ($this->selectedSizeFound) {
            // Get the authenticated user
            if (Auth::check()) {
                $user = Auth::user();

                // Check if there is an existing order that is not yet ordered for the user
                $order = Order::where([
                    ['user_id', 'like', $user->id],
                    ['isOrdered', 'like', false]
                ])->first();

                // If no existing order found, create a new order for the user
                if (!$order) {
                    $order = Order::create([
                        'user_id' => Auth::user()->id
                    ]);
                }

                // Check if an order line with the same size and product already exists
                $existingOrderLine = OrderLine::where([
                    ['order_id', $order->id],
                    ['product_id', $product->id],
                    ['size', $this->sizeName]
                ])->first();

                // If an existing order line found, display a warning toast message
                if ($existingOrderLine) {
                    $this->dispatchBrowserEvent('swal:toast', [
                        'background' => 'warning',
                        'html' => '<span class="font-bold">Dit product met de geselecteerde maat zit al in je winkelmandje.</span> <i class="fas fa-exclamation-circle"></i>',
                    ]);
                }
                // If no existing order line found, create a new order line and display a success toast message
                else {
                    OrderLine::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'size' => $this->sizeName,
                        'image_path' => $this->productImage
                    ]);

                    // Emit an event to refresh the navigation menu
                    $this->emit('refresh-navigation-menu');

                    // Display a success toast message
                    $this->dispatchBrowserEvent('swal:toast', [
                        'background' => 'success',
                        'html' => '<span class="font-bold">Product is toegevoegd aan je winkelmandje!</span> <i class="fas fa-check-circle text-green-500 ml-2"></i>',
                    ]);
                }
                // Reset the selected size flag
                $this->selectedSizeFound = false;
            } else {
                $this->dispatchBrowserEvent('swal:toast', [
                    'background' => 'error',
                    'html' => '<span class="font-bold">Maak een account om producten in je winkelmandje te steken!</span> <i class="fas fa-exclamation-circle"></i>',
                ]);
            }

        }
        // If no selected size found, display an error toast message
        else {
            $this->dispatchBrowserEvent('swal:toast', [
                'background' => 'error',
                'html' => "<span style='font-weight: bold;'>Selecteer een maat</span> om het product in je winkelmandje te steken! <i class='fas fa-exclamation-circle'></i>",
            ]);
        }
    }

    public function mount()
    {
        $this->minPrice = ceil(Product::min('price'));
        $this->maxPrice = ceil(Product::max('price'));
        $this->price = $this->maxPrice;

//        $this->filterSelectedSizes = Size::pluck('id')->toArray();

    }

    public function filterSize($sizeId)
    {
        // Check if the sizeId is already selected
        if (in_array($sizeId, $this->filterSelectedSizes)) {
            // Size is already selected, remove it from the selected sizes
            $this->filterSelectedSizes = array_diff($this->filterSelectedSizes, [$sizeId]);
        } else {
            // Add the sizeId to the selected sizes
            $this->filterSelectedSizes[] = $sizeId;
        }
    }

    public function toggleCategory($categoryId)
    {
        if (in_array($categoryId, $this->filterSelectedCategories)) {
            $this->filterSelectedCategories = array_diff($this->filterSelectedCategories, [$categoryId]);
        } else {
            $this->filterSelectedCategories[] = $categoryId;
        }
    }

    // Render method to fetch and return the products view
    public function render()
    {
        $selectedSizeIds = $this->filterSelectedSizes;
        $selectedCategoryIds = $this->filterSelectedCategories;

        $products = Product::query()
            ->when(count($selectedSizeIds) > 0, function ($query) use ($selectedSizeIds) {
                $query->whereHas('product_sizes', fn ($subquery) => $subquery->whereIn('size_id', $selectedSizeIds));
            })
            ->when(count($selectedCategoryIds) > 0, fn ($query) => $query->whereIn('category_id', $selectedCategoryIds))
            ->when($this->price, fn ($query) => $query->where('price', '<=', $this->price))
            ->where('name', 'like', "%{$this->filterProductName}%")
            ->when($this->sortBy === 'low_to_high', fn ($query) => $query->orderBy('price', 'asc'))
            ->when($this->sortBy === 'high_to_low', fn ($query) => $query->orderBy('price', 'desc'))
            ->get();

        $categories = Category::get();
        $sizes = Size::get();
        return view('livewire.shop', compact('products', 'sizes', 'categories'));
    }
}
