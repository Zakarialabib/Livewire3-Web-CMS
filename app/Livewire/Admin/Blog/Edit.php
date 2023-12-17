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

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $editModal = false;

    public $blog;

    #[Rule('min:1', 'This title must be a more than 3 characters')]
    #[Rule('max:255', message: 'This title is too long')]
    #[Rule('required', message: 'Please provide a name')]
    public $title;

    #[Rule('required|integer')]
    public $category_id;

    #[Rule('required|string')]
    public $slug;

    #[Rule('nullable')]
    #[Rule('max:100', message: 'This title is too long')]
    public $meta_title;

    #[Rule('nullable')]
    #[Rule('max:200', message: 'This title is too long')]
    public $meta_description;

    public $image;

    #[Rule('required|min:3')]
    public $description;

    #[Computed]
    public function blogCategories()
    {
        return BlogCategory::select('title', 'id')->get();
    }

    #[On('editModal')]
    public function editModal($id): void
    {
        // abort_if(Gate::denies('blog_edit'), 403);

        $this->resetErrorBag();

        $this->resetValidation();

        $this->blog = Blog::where('id', $id)->firstOrFail();
        $this->title = $this->blog->title;
        $this->category_id = $this->blog->category_id;
        $this->slug = $this->blog->slug;
        $this->meta_title = $this->blog->meta_title;
        $this->meta_description = $this->blog->meta_description;
        $this->image = $this->blog->image;
        $this->description = $this->blog->description;

        $this->editModal = true;
    }

    public function render()
    {
        // abort_if(Gate::denies('blog_create'), 403);

        return view('livewire.admin.blog.edit');
    }

    public function update(): void
    {
        if ( ! $this->image) {
            $this->image = null;
        } elseif (is_object($this->image) && method_exists($this->image, 'extension')) {
            $imageName = Str::slug($this->title).'.'.$this->image->extension();
            $this->image->store('blogs', $imageName);
            $this->blog->image = $imageName;
        }

        $this->blog->description = $this->description;

        $validated = $this->validate();

        $this->blog->update($validated);

        $this->alert('success', __('Blog updated successfully.'));

        $this->dispatch('refreshIndex');

        $this->editModal = false;
    }
}
