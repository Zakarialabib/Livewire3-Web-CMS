<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Email;

use App\Models\EmailTemplate;
use App\Livewire\Utils\Datatable;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.dashboard')]
class Index extends Component
{
    use Datatable;

    public $email;

    public function mount(): void
    {
        $this->orderable = (new EmailTemplate())->orderable;
    }

    public function render()
    {
        $query = EmailTemplate::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $emails = $query->paginate($this->perPage);

        return view('livewire.admin.email.index', ['emails' => $emails]);
    }

    // Blog Category  Delete
    public function delete(EmailTemplate $email): void
    {
        // abort_if(Gate::denies('email_delete'), 403);

        $email->delete();
    }
}
