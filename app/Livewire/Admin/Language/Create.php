<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Language;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class Create extends Component
{
    use LivewireAlert;

    public array $languages = [];

    public $language;

    #[Rule('required', message: 'The name is required')]
    #[Rule('max:191', 'The name must not exceed 191 characters')]
    public $name;

    #[Rule('required', message: 'The code is required')]
    public $code;

    public $createModal = false;

    #[On('createModal')]
    public function createModal(): void
    {
        $this->createModal = true;
    }

    public function create(): void
    {
        $this->validate();

        $this->language->save();

        File::copy(App::langPath().('/en.json'), App::langPath().('/'.$this->code.'.json'));

        $this->alert('success', __('Language created successfully!'));

        $this->dispatch('refreshIndex')->to(Index::class);

        $this->createModal = false;
    }

    public function render()
    {
        return view('livewire.admin.language.create');
    }
}
