<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

class Edit extends Component
{
    use LivewireAlert;

    public $editModal = false;

    public $user;

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

    #[On('editModal')]
    public function editModal($id): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->user = User::findOrfail($id);

        $this->editModal = true;
    }

    public function update(): void
    {
        $this->validate();

        $this->user->update();

        $this->alert('success', __('User Updated Successfully'));

        $this->editModal = false;

        $this->dispatch('refreshIndex')->to(Index::class);
    }

    public function render(): View
    {
        // abort_if(Gate::denies('user_edit'), 403);

        return view('livewire.admin.users.edit');
    }
}
