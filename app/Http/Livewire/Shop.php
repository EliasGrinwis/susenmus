<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Size;
use Auth;
use Livewire\Component;

class Shop extends Component
{

    public $sizeName;
    public $selectedSize;
    public $productImage;
    public $selectedSizeFound = false;

    public function updateSize(Size $size, Product $product, ProductSize $productSize)
    {
        $this->selectedSize = $productSize->id;
        $this->productImage = '/storage/' . $product->images[0]->image_path;
        $this->sizeName = $size->name;
    }

    public function createOrder(Product $product)
    {
        foreach ($product->product_sizes as $productSize) {
            if ($productSize->id === $this->selectedSize) {
                $this->selectedSizeFound = true;
            }
        }

        if ($this->selectedSizeFound) {
            $user = Auth::user();

            $order = Order::where([
                ['user_id', 'like', $user->id],
                ['isOrdered', 'like', false]
            ])->first();

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

            if ($existingOrderLine) {
                $this->dispatchBrowserEvent('swal:toast', [
                    'background' => 'warning',
                    'html' => '<span class="font-bold">Dit product met de geselecteerde maat zit al in je winkelmandje.</span> <i class="fas fa-exclamation-circle"></i>',
                ]);
            } else {
                OrderLine::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'size' => $this->sizeName,
                    'image_path' => $this->productImage
                ]);

                $this->emit('refresh-navigation-menu');

                $this->dispatchBrowserEvent('swal:toast', [
                    'background' => 'success',
                    'html' => '<span class="font-bold">Product is toegevoegd aan je winkelmandje!</span> <i class="fas fa-check-circle text-green-500 ml-2"></i>',
                ]);
            }
            $this->selectedSizeFound = false;
        } else {
            $this->dispatchBrowserEvent('swal:toast', [
                'background' => 'error',
                'html' => "<span style='font-weight: bold;'>Selecteer een maat</span> om het product in je winkelmandje te steken! <i class='fas fa-exclamation-circle'></i>",
            ]);
        }
    }

    public function render()
    {
        $products = Product::get();
        return view('livewire.shop', compact('products'));
    }
}
