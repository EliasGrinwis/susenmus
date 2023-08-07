<?php

namespace App\Http\Livewire\Layout\Admin;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class NavBar extends Component
{
    public $avatar;

    protected $listeners = ['refresh-navigation-menu' => '$refresh'];

    public function render()
    {
        if (auth()->user()) {
            $this->avatar = 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name);
            if (auth()->user()->profile_photo_path) {
                $this->avatar = asset('storage/' . auth()->user()->profile_photo_path);
            }
        }

        return view('livewire.layout.admin.nav-bar');
    }
}
