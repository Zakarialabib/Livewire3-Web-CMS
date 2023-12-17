<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Contact;
use Carbon\Carbon;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.dashboard')]
class Dashboard extends Component
{
    public $startDate;

    public $endDate;

    public function mount(): void
    {
        // Set default date range to the current month
        $this->startDate = Carbon::now()->startOfMonth()->toDateString();
        $this->endDate = Carbon::now()->endOfMonth()->toDateString();
    }

    public function render()
    {
        $contactsCount = Contact::whereBetween('created_at', [$this->startDate, $this->endDate])->count();
        $recentContacts = Contact::select('created_at', 'type', 'subject', 'name', 'id')->orderBy('created_at', 'desc')->take(10)->get();

        return view('livewire.admin.dashboard', ['contactsCount' => $contactsCount, 'recentContacts' => $recentContacts]);
    }
}
