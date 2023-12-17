<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Partner;

use App\Models\Partner;
use App\Livewire\Utils\Datatable;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('components.layouts.dashboard')]
class Index extends Component
{
    use Datatable;
    use LivewireAlert;
    public $partner;

    public $deleteModal = false;

    public $showModal = false;

    public function confirmed(): void
    {
        $this->dispatch('delete');
    }

    public function mount(): void
    {
        $this->orderable = (new Partner())->orderable;
    }

    public function render()
    {
        // abort_if(Gate::denies('partner_access'), 403);

        $query = Partner::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $partners = $query->paginate($this->perPage);

        return view('livewire.admin.partners.index', ['partners' => $partners]);
    }

    #[On('showModal')]
    public function showModal(Partner $partner): void
    {
        // abort_if(Gate::denies('partner_show'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->partner = $partner;

        $this->showModal = true;
    }

    public function deleteModal($partner): void
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'cancelButtonText'  => __('Cancel'),
            'onConfirmed'       => 'delete',
        ]);
        $this->partner = $partner;
    }

    public function deleteSelected(): void
    {
        abort_if(Gate::denies('partner_delete'), 403);

        Partner::whereIn('id', $this->selected)->delete();

        $this->resetSelected();

        $this->alert('success', __('Selected partners deleted successfully.'));
    }

    #[On('delete')]
    public function delete(): void
    {
        abort_if(Gate::denies('partner_delete'), 403);

        Partner::findOrFail($this->partner)->delete();

        $this->alert('success', __('Partner deleted successfully.'));
    }
}
