<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

use App\Models\Redirect;
use App\Livewire\Utils\Datatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Redirects extends Component
{
    use LivewireAlert;
    use Datatable;

    public $editModal = false;

    public $redirect;

    protected $rules = [
        'redirect.old_url' => 'required',
        'redirect.new_url' => 'nullable',
    ];

    public function mount(): void
    {
        $this->orderable = (new Redirect())->orderable;
    }

    public function editModal($id): void
    {
        $this->redirect = Redirect::find($id);
        $this->editModal = true;
    }

    public function update(): void
    {
        $this->validate();

        $this->redirect->save();

        $this->alert('warning', __('Redirect updated successfully!'));

        $this->editModal = false;

        $this->dispatch('refreshIndex');
    }

    public function delete(Redirect $redirect): void
    {
        $redirect->delete();

        $this->alert('warning', __('Redirect deleted successfully!'));
    }

    public function render()
    {
        $query = Redirect::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $redirects = $query->paginate($this->perPage);

        return view('livewire.admin.settings.redirects', ['redirects' => $redirects]);
    }
}
