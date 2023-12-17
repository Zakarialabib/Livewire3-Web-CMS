<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Email;

use App\Models\EmailTemplate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createModal = false;

    public $email_setting;

    public $description;

    public $message;

    protected $rules = [
        'email_setting.name'         => ['required', 'max:255'],
        'description'                => ['required'],
        'message'                    => ['required'],
        'email_setting.default'      => ['required'],
        'email_setting.placeholders' => ['required'],
        'email_setting.type'         => ['required'],
        'email_setting.subject'      => ['required'],
        'email_setting.status'       => ['required'],
    ];

    public function updatedMessage($value): void
    {
        $this->message = $value;
    }

    public function render()
    {
        return view('livewire.admin.email.create');
    }

    #[On('createModal')]
    public function createModal(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->email_setting = new EmailTemplate();
        $this->description = '';
        $this->message = '';
        $this->createModal = true;
    }

    public function store(): void
    {
        $this->validate();

        $this->email_setting->description = $this->description;
        $this->email_setting->message = $this->message;

        $this->email_setting->save();

        $this->alert('success', __('Email template created successfully.'));

        $this->dispatch('refreshIndex');

        $this->createModal = false;
    }
}
