<?php

declare(strict_types=1);

namespace App\Livewire\Admin\BlogCategory;

use App\Models\BlogCategory;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;

class Edit extends Component
{
    use LivewireAlert;

    public $blogcategory;

    #[Rule('required', message: 'Please provide a post title')]
    #[Rule('min:3', message: 'This title must be a more than 3 characters')]
    #[Rule('max:255', message: 'This title is too long')]
    public $title;

    #[Rule('nullable')]
    public $description;

    #[Rule('nullable', 'This meta title is too long')]
    #[Rule('max:100', message: 'This meta title is too long')]
    public $meta_title;

    #[Rule('nullable', 'This meta description is too long')]
    #[Rule('max:200', message: 'This meta description is too long')]
    public $meta_description;

    public $editModal = false;

    #[On('editModal')]
    public function editModal($id): void
    {
        // abort_if(Gate::denies('blogcategory_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->blogcategory = BlogCategory::where('id', $id)->firstOrFail();

        $this->title = $this->blogcategory->title;
        $this->description = $this->blogcategory->description;
        $this->meta_title = $this->blogcategory->meta_title;
        $this->meta_description = $this->blogcategory->meta_description;
        $this->editModal = true;
    }

    public function update(): void
    {
        $this->validate();

        $this->blogcategory->update(
            $this->all(),
        );

        $this->alert('success', __('BlogCategory updated successfully'));

        $this->dispatch('refreshIndex');

        $this->editModal = false;
    }

    public function render(): View
    {
        return view('livewire.admin.blog-category.edit');
    }
}
