<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;

    public $createModal;

    public User $user;

    #[Rule('required|string|max:255')]
    public $name;

    #[Rule('required|email|unique:users,email')]
    public $email;

    #[Rule('required|string|min:8')]
    public $password;

    #[Rule('required|numeric')]
    public $phone;

    #[Rule('nullable')]
    public $city;

    #[Rule('nullable')]
    public $country;

    public function render()
    {
        return view('livewire.admin.users.create');
    }

    public function createModal(): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createModal = true;
    }

    public function store(): void
    {
        $this->validate();

        User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => bcrypt($this->password),
            'phone'    => $this->phone,
            'city'     => $this->city,
            'country'  => $this->country,
        ]);

        $this->dispatch('refreshIndex')->to(Index::class);

        $this->alert('success', __('User created successfully.'));

        $this->createModal = false;
    }
}
