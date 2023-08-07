<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ManageUsers extends Component
{
    use WithPagination;

    // public properties
    public $perPage = 9;

    // filter
    public $filterName;

    public $showModal;
    public $editUser = [
        'id' => null,
        'name' => null,
        'email' => null,
        'role_id' => null,
        'profile_image' => null,
    ];

    // HERE WE WRITE THE VALIDATION RULES
    public function rules()
    {
        return [
            'editUser.name' => 'required',
            'editUser.email' => [
                'required',
                'min:3',
                Rule::unique('users', 'email')->ignore($this->editUser['id']),
            ],
        ];
    }

    // HERE WE OPEN THE SHOW MODAL TO EDIT THE USER
    public function editUser(User $user = null)
    {
        $this->resetErrorBag();
        if ($user) {
            $this->editUser['id'] = $user->id;
            $this->editUser['name'] = $user->name;
            $this->editUser['email'] = $user->email;
            $this->editUser['role_id'] = $user->role_id;
            if ($user->profile_photo_path == null) {
                $this->editUser['profile_image'] = 'https://ui-avatars.com/api/?name=' . urlencode($user->name);
            } else {
                $this->editUser['profile_image'] = 'http://localhost/storage/' . $user->profile_photo_path;
            }
        } else {
            $this->reset('editUser');
        }
        $this->showModal = true;
    }

    // HERE WE UPDATE THE USER WITH THE NEW VALUES
    public function updateUser(User $user)
    {
        $this->validate();
        $user->update([
            'name' => $this->editUser['name'],
            'email' => $this->editUser['email'],
            'role_id' => $this->editUser['role_id']
        ]);

        $this->showModal = false;
        $this->reset('editUser');

        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De gebruiker is bewerkt!",
        ]);
    }

    // listen to the delete-user event
    protected $listeners = [
        'delete-user' => 'deleteUser',
    ];

    // delete a user
    public function deleteUser(User $user)
    {
        $user->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De gebruiker <b><i>{$user->name}</i></b> is verwijderd!",
        ]);
    }

    public function render()
    {
        $users = User::orderBy('name')
            ->where([
                ['name', 'like', "%{$this->filterName}%"]
            ])
            ->paginate($this->perPage);
        $roles = Role::get();

        return view('livewire.manage-users', compact('users', 'roles'))->layout('layouts.dashboard');
    }
}
