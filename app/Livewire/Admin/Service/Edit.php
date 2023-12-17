<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use App\Models\Language;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $service;

    #[Rule('required|max:191')]
    public $title;

    public $features;

    public $options;

    #[Rule('nullable')] // 1MB Max
    public $image;

    #[Rule('min:3')]
    public $content;

    public $slug;

    public $editModal = false;

    #[On('editModal')]
    public function editModal($id): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->service = Service::where('id', $id)->first();

        $this->image = $this->service->image ?? '';

        $this->content = $this->service->content;

        $this->title = $this->service->title;
        $this->features = $this->service->features;
        $this->options = $this->service->options;
        $this->editModal = true;
    }

    public function render()
    {
        return view('livewire.admin.service.edit');
    }

    public function update(): void
    {
        $this->slug = Str::slug($this->title);

        if ( ! $this->image) {
            $this->image = null;
        } elseif (is_object($this->image) && method_exists($this->image, 'extension')) {
            $imageName = Str::slug($this->title).'.'.$this->image->extension();
            $this->image->storeAs('services', $imageName, 'local_files');
            $this->image = $imageName;
        }

        $validated = $this->validate();

        $this->service->update($validated);

        $this->alert('success', __('Service updated successfully!'));

        $this->dispatch('refreshIndex');

        $this->reset(['title', 'features', 'options', 'image', 'content']);

        $this->editModal = false;
    }

    public function getLanguagesProperty()
    {
        return Language::pluck('name', 'id')->toArray();
    }
}
