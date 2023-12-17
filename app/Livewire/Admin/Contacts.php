<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Models\Contact;
use App\Livewire\Utils\Datatable;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.dashboard')]
class Contacts extends Component
{
    use Datatable;
    use LivewireAlert;

    public function mount(): void
    {
        $this->sortBy = 'id';
        $this->sortDirection = 'desc';
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable = (new Contact())->orderable;
    }

    public function render()
    {
        $query = Contact::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $contacts = $query->paginate($this->perPage);

        return view('livewire.admin.contacts', ['contacts' => $contacts]);
    }

    public function deleteSelected(): void
    {
        Contact::whereIn('id', $this->selected)->delete();

        // $this->showDeleteModal = false;
    }

    public function delete(Contact $contact): void
    {
        $contact->delete();

        $this->alert('warning', __('Contact deleted successfully!'));
    }
}
