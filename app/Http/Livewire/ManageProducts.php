<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Size;
use Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Request;
use Storage;

class ManageProducts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $newProduct = ['id' => null, 'category_id' => null, 'name' => null, 'price' => null];
    public $images = [];

    // sizes
    public $selectedSizesWithQuantity = [];

    public $quantities = [];

    public $showModal;

    // public properties
    public $perPage = 9;


    public function openModal()
    {
        $this->reset('newProduct');
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

//    public function save()
//    {
//        // Your logic to handle the uploaded images goes here
//        // Access the uploaded images using $this->images
//        // For example, you can store them in a database or process them in some way
//        dd('save');
//    }

    public function removeImage($imagePath)
    {
        // Find the index of the image in the $images array
        $index = array_search($imagePath, $this->images);

        if ($index !== false) {
            // Remove the image from the array
            unset($this->images[$index]);

            // Re-index the array after removal
            $this->images = array_values($this->images);

            // Delete the image from storage
            Storage::delete($imagePath);
        }
    }

    public function updatedImages()
    {
        // Create a temporary array to store temporary image instances
        $tempImages = [];

        // Handle temporary storage of images
        foreach ($this->images as $image) {
            $tempImages[] = $image->store('temporary', 'public'); // Store images temporarily in the 'temporary' folder within 'public' disk
        }

        // Store the temporary image instances in the $images array
        $this->images = $tempImages;
    }


    public function createProduct()
    {
        $product = Product::create([
            'category_id' => $this->newProduct['category_id'],
            'name' => $this->newProduct['name'],
            'price' => $this->newProduct['price'],
        ]);

        foreach ($this->selectedSizesWithQuantity as $sizeId => $data) {
            if ($data['size']) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'size_id' => $sizeId,
                    'max_quantity_available' => $data['quantity'] ?? 0,
                ]);
            }
        }

        // Handle temporary storage of images and move them to permanent location
        foreach ($this->images as $image) {
//            $originalImage = Image::make('http://susenmus.test/storage/' . $image)->encode('jpg', 75); // local
            $originalImage = Image::make('https://susenmus.kmaa.be/storage/' . $image)->encode('jpg', 75); // production
            $imagePath = 'products/' . uniqid() . '.jpg'; // Generate a unique filename for each image

            Storage::disk('public')->put($imagePath, $originalImage);

            \App\Models\Image::create([
                'product_id' => $product->id,
                'image_path' => $imagePath,
            ]);
        }

        Storage::disk('public')->deleteDirectory('temporary');

        $this->showModal = false;

        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "<b>Success!</b> Het product is aangemaakt.",
        ]);

    }

    public function render()
    {
        $categories = Category::get();
        $sizes = Size::get();
        $products = Product::orderBy('name')->with('images', 'product_sizes')->paginate($this->perPage);
        return view('livewire.manage-products', compact('products', 'categories', 'sizes'))->layout('layouts.dashboard');
    }
}
