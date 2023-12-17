<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Page;

use App\Models\Page;
use App\Livewire\Utils\Datatable;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

#[Layout('components.layouts.dashboard')]
class Index extends Component
{
    use WithPagination;
    use Datatable;
    use LivewireAlert;

    public $deleteModal = false;

    public $page;

    public function mount(): void
    {
        $this->orderable = (new Page())->orderable;
    }

    public function render()
    {
        $query = Page::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $pages = $query->paginate($this->perPage);

        return view('livewire.admin.page.index', ['pages' => $pages]);
    }

    #[On('delete')]
    public function delete(): void
    {
        // abort_if(Gate::denies('page_delete'), 403);

        Page::findOrFail($this->page)->delete();

        $this->alert('success', __('Page deleted successfully.'));
    }

    public function deleteSelected(): void
    {
        // abort_if(Gate::denies('page_delete'), 403);

        Page::whereIn('id', $this->selected)->delete();

        $this->resetSelected();

        $this->alert('success', __('Page deleted successfully.'));
    }

    public function confirmed(): void
    {
        $this->dispatch('delete');
    }

    public function deleteModal($page): void
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'cancelButtonText'  => __('Cancel'),
            'onConfirmed'       => 'delete',
        ]);
        $this->page = $page;
    }
}
