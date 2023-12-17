<?php

declare(strict_types=1);

namespace App\Livewire\Front;

use App\Models\Contact;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Traits\LazySpinner;
use Livewire\Attributes\Rule;

class ContactForm extends Component
{
    use LivewireAlert;
    use LazySpinner;

    public Contact $contact;

    #[Rule('required', message: 'The name field is required')]
    #[Rule('min:3', message: 'The name field must be at least 3 characters')]
    #[Rule('max:255', message: 'The name field must not exceed 255 characters')]
    public $name;

    #[Rule('required', message: 'The email field is required')]
    #[Rule('email', message: 'The email field must be a valid email address')]
    public $email;

    #[Rule('required', message: 'The phone number field is required')]
    #[Rule('numeric', message: 'The phone number field must be a numeric value')]
    public $phone_number;

    #[Rule('required', message: 'The message field is required')]
    #[Rule('min:3', message: 'The message field is required must be at least 3 characters')]
    public $message;

    public $subject;

    public $type;

    public $page;

    public $school_name;

    public $company_name;

    public function render()
    {
        return view('livewire.front.contact-form');
    }

    public function mount($type = null, $page = null): void
    {
        $this->type = $type;
        $this->page = $page;
    }

    public function store(): void
    {
        $this->validate();

        $subject = __('You have a form submission in page ').$this->page;

        if ($this->name) {
            $subject .= ' | '.__('Name : ').$this->name;
        }

        if ($this->company_name) {
            $subject .= ' | '.__('client type : Company ').$this->company_name;
        }

        if ($this->school_name) {
            $subject .= ' | '.__('client type : School ').$this->school_name;
        }

        $contact = Contact::create(
            [
                'name'         => $this->name,
                'email'        => $this->email,
                'phone_number' => $this->phone_number,
                'message'      => $this->message,
                'subject'      => $subject,
                'type'         => $this->type,
            ]
        );

        $this->alert('success', __('Your Message is sent succesfully.'));

        $admin = User::whereHas('roles', static function ($query): void {
            $query->where('name', 'admin');
        })->first();

        if ($admin) {
            Mail::to($admin->email)->later(now()->addMinutes(10), new ContactFormMail($contact));
        }

        $this->reset(['name', 'email', 'phone_number', 'message']);
    }
}
