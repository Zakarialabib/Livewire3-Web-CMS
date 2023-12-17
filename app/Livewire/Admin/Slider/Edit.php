<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Slider;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use App\Models\Slider;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $editModal = false;

    public $slider;

    #[Rule('required', message: 'The title is required')]
    #[Rule('max:255', message: 'The title must not exceed 255 characters')]
    public $title;

    #[Rule('nullable', 'string', 'max:255')]
    public $subtitle;

    #[Rule('nullable')]
    public $link;

    #[Rule('nullable')]
    public $bg_color;

    #[Rule('nullable')]
    public $embeded_video;

    public $image;

    #[Rule('nullable')]
    public $description;

    #[On('editModal')]
    public function editModal($id): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->slider = Slider::where('id', $id)->first();
        $this->title = $this->slider->title;
        $this->subtitle = $this->slider->subtitle;
        $this->link = $this->slider->link;
        $this->bg_color = $this->slider->bg_color;
        $this->embeded_video = $this->slider->embeded_video;

        $this->description = $this->slider->description;

        $this->image = $this->slider->image;

        $this->editModal = true;
    }

    public function update(): void
    {
        $this->validate();

        if ( ! $this->image) {
            $this->image = null;
        } elseif (is_object($this->image) && method_exists($this->image, 'extension')) {
            $path = public_path().'/images/sliders/'.basename((string) $this->image);
            Storage::delete($path);

            $fileName = Str::slug($this->title).Str::random(5).'-'.'.'.$this->image->extension();
            $this->image->storeAs('sliders', $fileName, 'local_files');
            $this->image = $fileName;
        }

        $this->slider->update(
            $this->all(),
        );

        $this->alert('success', __('Slider updated successfully.'));

        $this->dispatch('refreshIndex')->to(Index::class);

        $this->editModal = false;
    }

    public function render(): View
    {
        return view('livewire.admin.slider.edit');
    }
}
