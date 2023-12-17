<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public Service $service;

    public $image;

    #[Rule('required|unique:services,title|max:191')]
    public $title;

    #[Rule('nullable')]
    public $features;

    #[Rule('nullable')]
    public $options;

    #[Rule('min:3')]
    public $content;

    public $slug;

    public $createModal = false;

    #[On('createModal')]
    public function createModal(): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->content = '';

        $this->createModal = true;
    }

    public function render()
    {
        return view('livewire.admin.service.create');
    }

    public function store(): void
    {
        $validated = $this->validate();

        $this->slug = Str::slug($this->title);

        if ( ! $this->image) {
            $this->image = null;
        } elseif (is_object($this->image) && method_exists($this->image, 'extension')) {
            $imageName = Str::slug($this->title).'.'.$this->image->extension();
            $this->image->storeAs('services', $imageName, 'local_files');
            $this->service->image = $imageName;
        }

        Service::create($validated);

        $this->alert('success', __('Service created successfully!'));

        $this->dispatch('refreshIndex');

        $this->reset(['title', 'features', 'options', 'image', 'content']);

        $this->createModal = false;
    }
}
