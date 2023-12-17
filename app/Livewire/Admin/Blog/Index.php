<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Blog;

use App\Models\Blog;
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

    public $blog;

    public $deleteModal = false;

    public function mount(): void
    {
        $this->orderable = (new Blog())->orderable;
    }

    #[On('delete')]
    public function delete(): void
    {
        abort_if(Gate::denies('blog_delete'), 403);

        Blog::findOrFail($this->blog)->delete();

        $this->alert('success', __('Blog deleted successfully.'));
    }

    public function deleteSelected(): void
    {
        abort_if(Gate::denies('blog_delete'), 403);

        Blog::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function deleteModal($blog): void
    {
        $this->confirm(__('Are you sure you want to delete this?'), [
            'toast'             => false,
            'position'          => 'center',
            'showConfirmButton' => true,
            'cancelButtonText'  => __('Cancel'),
            'onConfirmed'       => 'delete',
        ]);
        $this->blog = $blog;
    }

    public function render()
    {
        $query = Blog::advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $blogs = $query->paginate($this->perPage);

        return view('livewire.admin.blog.index', ['blogs' => $blogs]);
    }
}
