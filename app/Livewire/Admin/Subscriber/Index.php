<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Subscriber;

use App\Models\Subscriber;
use App\Livewire\Utils\Datatable;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('components.layouts.dashboard')]
class Index extends Component
{
    use Datatable;
    use LivewireAlert;

    public $subscriber;

    public function mount(): void
    {
        $this->orderable = (new Subscriber())->orderable;
    }

    public function render(): View
    {
        $query = Subscriber::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $subscribers = $query->paginate($this->perPage);

        return view('livewire.admin.subscriber.index', ['subscribers' => $subscribers]);
    }

    public function deleteModal($subscriber): void
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'cancelButtonText'  => __('Cancel'),
            'onConfirmed'       => 'delete',
        ]);
        $this->subscriber = $subscriber;
    }

    #[On('delete')]
    public function delete(): void
    {
        // abort_if(Gate::denies('subscriber_delete'), 403);

        Subscriber::findOrFail($this->subscriber)->delete();

        $this->alert('success', __('Subscriber deleted successfully.'));
    }
}
