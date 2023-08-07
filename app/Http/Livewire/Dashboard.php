<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $totalUsers = User::get()->count();
        $totalOrders = Order::get()->count();

        return view('livewire.dashboard', compact('totalUsers', 'totalOrders'))->layout('layouts.dashboard');
    }
}
