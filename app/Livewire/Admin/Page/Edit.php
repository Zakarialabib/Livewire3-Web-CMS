<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Page;

use App\Models\Page;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;

Should:
#[Layout('components.layouts.dashboard')]
class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $page;

    public $image;

    #[Rule('required', message: 'The title is required')]
    #[Rule('min:3', message: 'The title must be at least 3 characters')]
    #[Rule('max:255', message: 'The title must not exceed 255 characters')]
    public $title;

    public $slug;

    public $description;

    #[Rule('nullable', 'The meta title must be a valid string')]
    #[Rule('max:100', message: 'The meta title must not exceed 100 characters')]
    public $meta_title;

    #[Rule('nullable', 'The meta description must be a valid string')]
    #[Rule('max:200', message: 'The meta description must not exceed 200 characters')]
    public $meta_description;

    #[Rule('array')]
    public $settings;

    public $type;

    public $status;

    #[On('editorjs-save')]
    public function saveEditorState($editorJsonData): void
    {
        $this->description = $editorJsonData;
    }

    public function mount($id): void
    {
        $this->page = Page::where('id', $id)->firstOrFail();
        $this->title = $this->page->title;
        $this->slug = $this->page->slug;
        $this->type = $this->page->type;
        $this->image = $this->page->image;
        $this->description = $this->page->description;
        $this->meta_title = $this->page->meta_title;
        $this->meta_description = $this->page->meta_description;

        // is string or is array
        if (is_string($this->page->settings)) {
            $this->settings = json_decode($this->page->settings, true, 512, JSON_THROW_ON_ERROR);
        } else {
            $this->settings = $this->page->settings;
        }

        $this->status = $this->page->status;
    }

    public function update(): void
    {
        $this->validate();

        $this->page->slug = Str::slug($this->page->name);

        if ( ! $this->image) {
            $this->image = null;
        } elseif (is_object($this->image) && method_exists($this->image, 'extension')) {
            $imageName = Str::slug($this->page->name).'.'.$this->image->extension();
            $this->image->storeAs('pages', $imageName, 'local_files');
            $this->page->image = $imageName;
        }

        $this->page->settings = json_encode($this->settings, JSON_THROW_ON_ERROR);

        $this->page->update(
            $this->all()
        );

        $this->alert('success', __('Page updated successfully.'));
    }

    public function render()
    {
        return view('livewire.admin.page.edit');
    }
}
