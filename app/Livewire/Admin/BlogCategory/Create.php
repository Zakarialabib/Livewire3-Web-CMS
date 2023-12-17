<?php

declare(strict_types=1);

namespace App\Livewire\Admin\BlogCategory;

use App\Models\BlogCategory;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createModal = false;

    public BlogCategory $blogcategory;

    #[Rule('required', message: 'Please provide a post title')]
    #[Rule('string', 'This title must be a string')]
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

    public function render()
    {
        abort_if(Gate::denies('blogcategory_create'), 403);

        return view('livewire.admin.blog-category.create');
    }

    #[On('createModal')]
    public function createModal(): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->createModal = true;
    }

    public function store(): void
    {
        $validated = $this->validate();

        $this->meta_title = $this->title;
        $this->meta_description = $this->description;

        BlogCategory::create($validated);

        $this->alert('success', __('BlogCategory created successfully.'));

        $this->createModal = false;

        $this->dispatch('refreshIndex');
    }
}
