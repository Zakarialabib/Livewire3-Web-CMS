<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Partner;

use App\Models\Partner;
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

    public Partner $partner;

    public $image;

    #[Rule('required', message: 'string', 'max:255')]
    public $name;

    #[Rule('nullable', 'string')]
    public $description;

    public function render()
    {
        abort_if(Gate::denies('partner_create'), 403);

        return view('livewire.admin.partners.create');
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
            $imageName = Str::slug($this->name).$this->image->extension();
            $this->image->storeAs('partners', $imageName, 'local_files');
            $this->image = $imageName;
        }

        Partner::create([
            'name'        => $this->name,
            'description' => $this->description,
            'image'       => $this->image,
        ]);

        $this->alert('success', __('Partner created successfully.'));

        $this->dispatch('refreshIndex')->to(Index::class);

        $this->createModal = false;
    }
}
