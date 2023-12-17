<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Blog;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $createModal = false;

    public Blog $blog;

    #[Rule('required', message: 'The title is required')]
    #[Rule('min:3', message: 'The title must be at least 3 characters')]
    #[Rule('max:255', message: 'The title must not exceed 255 characters')]
    public $title;

    #[Rule('required', message: 'The category ID is required')]
    #[Rule('integer', 'The category ID must be an integer')]
    public $category_id;

    public $slug;

    #[Rule('nullable', 'The meta title must not exceed 100 characters')]
    #[Rule('max:100', message: 'The meta title must not exceed 100 characters')]
    public $meta_title;

    #[Rule('nullable', 'The meta description must not exceed 200 characters')]
    #[Rule('max:200', message: 'The meta description must not exceed 200 characters')]
    public $meta_description;

    #[Rule('required', message: 'The description is required')]
    #[Rule('min:3', message: 'The description must be at least 3 characters')]
    public $description;

    public $image;

    public function render()
    {
        // abort_if(Gate::denies('blog_create'), 403);

        return view('livewire.admin.blog.create');
    }

    #[On('createModal')]
    public function createModal(): void
    {
        $this->resetErrorBag();

        $this->resetValidation();

        $this->description = '';

        $this->slug = Str::slug($this->title);

        $this->meta_title = $this->title;

        $this->meta_description = $this->description;

        $this->createModal = true;
    }

    public function store(): void
    {
        $this->validate();

        if ( ! $this->image) {
            $this->image = null;
        } elseif (is_object($this->image) && method_exists($this->image, 'extension')) {
            $fileName = Str::slug($this->title).'.'.$this->image->extension();
            $this->image->storeAs('blogs', $fileName, 'local_files');
            $this->image = $fileName;
        }

        Blog::create(
            $this->all(),
        );

        $this->dispatch('refreshIndex')->to(Index::class);

        $this->alert('success', __('Blog created successfully.'));

        $this->createModal = false;
    }

    #[Computed]
    public function blogCategories()
    {
        return BlogCategory::select('title', 'id')->get();
    }
}
