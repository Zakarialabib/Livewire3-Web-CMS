<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createModal = false;

    public Slider $slider;

    #[Rule('required', message: 'The title field is required')]
    #[Rule('max:255', message: 'The title field must be max 255 characters')]

    public $title;

    #[Rule('nullable', 'max:255')]
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

    public function render()
    {
        abort_if(Gate::denies('slider_create'), 403);

        return view('livewire.admin.slider.create');
    }

    #[On('createModal')]
    public function createModal(): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createModal = true;
    }

    public function store(): void
    {
        $this->validate();

        if ( ! $this->image) {
            $this->image = null;
        } elseif (is_object($this->image) && method_exists($this->image, 'extension')) {
            $imageName = Str::slug($this->title).Str::random(5).'-'.'.'.$this->image->extension();
            $this->image->storeAs('sliders', $imageName, 'local_files');
            $this->image = $imageName;
        }

        Slider::create([
            'title'         => $this->title,
            'subtitle'      => $this->subtitle,
            'description'   => $this->description,
            'link'          => $this->link,
            'bg_color'      => $this->bg_color,
            'embeded_video' => $this->embeded_video,
            'image'         => $this->image,
        ]);

        $this->alert('success', __('Slider created successfully.'));

        $this->dispatch('refreshIndex')->to(Index::class);

        $this->createModal = false;
    }
}
