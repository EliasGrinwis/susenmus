<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderLine;
use Auth;
use Livewire\Component;

class NavBarShop extends Component
{
    public $avatar;

    public $amounts = array();
    public $totalPrice;

    public $cartOverviewVisible = false;


    protected $listeners = ['refresh-navigation-menu' => '$refresh'];

    public function deleteOrderLine(OrderLine $orderLine)
    {
        $this->cartOverviewVisible = true;

        $orderLine->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => '<span class="font-bold text-green-500">Product is succesvol verwijderd uit je winkelmandje!</span> <i class="fas fa-check-circle text-green-500"></i>',
        ]);
    }

    public function updateQuantity(OrderLine $orderLine)
    {
        $this->cartOverviewVisible = true;
        $orderLine->update([
            'amount' => $this->amounts[$orderLine->id]['amount']
        ]);

    }

    public function mount()
    {
        if (auth()->user()) {
            $orders = Order::where([
                ['user_id', 'like', Auth::user()->id],
                ['isOrdered', 'like', false]
            ])->first();

            foreach ($orders->order_lines as $orderLine) {
                $this->amounts[$orderLine->id] = ['amount' => $orderLine->amount];
            }
        }
    }

    public function render()
    {
        if (auth()->user()) {
            $this->avatar = 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name);
            if (auth()->user()->profile_photo_path) {
                $this->avatar = asset('storage/' . auth()->user()->profile_photo_path);
            }

            $orders = Order::where([
                ['user_id', 'like', Auth::user()->id],
                ['isOrdered', 'like', false],
            ])->first();
        } else {
            $orders = [];
        }

        return view('livewire.nav-bar-shop', compact('orders'));
    }
}
