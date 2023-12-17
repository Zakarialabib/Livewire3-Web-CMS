<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Role;

use App\Models\Role;
use App\Livewire\Utils\Datatable;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use Datatable;
    use LivewireAlert;

    public function mount(): void
    {
        $this->orderable = (new Role())->orderable;
    }

    public function render()
    {
        $query = Role::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $roles = $query->paginate($this->perPage);

        return view('livewire.admin.role.index', ['roles' => $roles]);
    }

    public function deleteSelected(): void
    {
        abort_if(Gate::denies('role_delete'), 403);

        Role::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(Role $role): void
    {
        abort_if(Gate::denies('role_delete'), 403);

        $role->delete();

        $this->alert('success', __('Role deleted successfully.'));
    }
}
