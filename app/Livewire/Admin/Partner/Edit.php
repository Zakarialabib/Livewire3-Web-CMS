<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Partner;

use App\Models\Partner;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class Edit extends Component
{
    use LivewireAlert;
    public $partner;

    public $editModal = false;

    public $image;

    #[Rule('required', message: 'The name field is required')]
    #[Rule('max:255', message: 'The name field must be less than 255 characters')]
    public $name;

    #[Rule('nullable')]
    public $description;

    #[On('editModal')]
    public function editModal($id): void
    {
        // abort_if(Gate::denies('partner_update'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->partner = Partner::findOrfail($id);

        $this->name = $this->partner->name;

        $this->description = $this->partner->description;

        $this->image = $this->partner->image;

        $this->editModal = true;
    }

    public function update(): void
    {
        // abort_if(Gate::denies('partner_update'), 403);

        $this->validate();

        if ( ! $this->image) {
            $this->image = null;
        } elseif (is_object($this->image) && method_exists($this->image, 'extension')) {
            $imageName = Str::slug($this->name).$this->image->extension();
            $this->image->storeAs('partners', $imageName, 'local_files');
            $this->image = $imageName;
        }

        $this->partner->update([
            'name'        => $this->name,
            'description' => $this->description,
            'image'       => $this->image,
        ]);

        $this->alert('success', __('Partner updated successfully.'));

        $this->dispatch('refreshIndex')->to(Index::class);

        $this->editModal = false;
    }

    public function render(): View
    {
        return view('livewire.admin.partners.edit');
    }
}
