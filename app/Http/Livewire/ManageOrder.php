<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;

class ManageOrder extends Component
{
    use WithPagination;

    // public properties
    public $perPage = 9;

    public $showModal;
    public $orderFromUser;

    public function openOrder(Order $order)
    {
        $this->orderFromUser = $order;

        $this->showModal = true;
    }

    public function updateOrder(Order $order)
    {
        $order->update([
            'status_id' => 2 // Order is completed
        ]);

        $this->showModal = false;
    }

    public function render()
    {
        $orders = Order::orderBy('order_date')->paginate($this->perPage);
        $statuses = Status::get();

        return view('livewire.manage-order', compact('orders', 'statuses'))->layout('layouts.dashboard');
    }
}
