<?php

declare(strict_types=1);

namespace App\Livewire\Front;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Account extends Component
{
    use LivewireAlert;

    public $user;

    #[Rule('required', message: 'Please provide a name')]
    #[Rule('max:255', message: 'The name must not exceed 255 characters')]
    public $name;

    #[Rule('required', message: 'Please provide a phone number')]
    #[Rule('max:255', message: 'The phone number must not exceed 255 characters')]
    public $phone;

    #[Rule('required', message: 'Please provide an email address')]
    #[Rule('email', 'Please provide a valid email address')]
    #[Rule('max:255', message: 'The email address must not exceed 255 characters')]
    public $email;

    #[Rule('required', message: 'Please provide a city')]
    #[Rule('max:255', message: 'The city must not exceed 255 characters')]
    public $city;

    public $country;

    public string $password = '';

    public function mount(): void
    {
        $this->user = User::find(Auth::user()->id);
        $this->name = $this->user->name;
        $this->phone = $this->user->phone;
        $this->city = $this->user->city;
        $this->country = $this->user->country;
        $this->email = $this->user->email;
        $this->password = $this->user->password;
    }

    public function store(): void
    {
        $this->validate();

        if ($this->password !== '') {
            $this->user->password = bcrypt($this->password);
        }

        $this->user->update();

        $this->alert(
            'success',
            __('your account has been updated successfully!'),
            [
                'position'          => 'center',
                'timer'             => 3000,
                'toast'             => true,
                'text'              => '',
                'confirmButtonText' => 'Ok',
                'cancelButtonText'  => 'Cancel',
                'showCancelButton'  => false,
                'showConfirmButton' => false,
            ]
        );
    }

    public function render()
    {
        return view('livewire.front.account');
    }
}
