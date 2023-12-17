<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Models\Gallery;
use App\Models\Service;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.dashboard')]
class GalleryManager extends Component
{
    use WithFileUploads;
    public $image;

    public $gallery;

    #[Rule('min:3|max:120')]
    public $tag;

    public $showEdit = false;

    public function editImage($id): void
    {
        // Find the gallery record by ID
        $this->gallery = Gallery::find($id);

        // Set the input fields with the gallery record values
        $this->tag = $this->gallery->tag;

        $this->showEdit = true;
    }

    public function updateImage(): void
    {
        // Validate the input fields
        $this->validate();

        // Update the gallery record
        $this->gallery->update([
            'tag' => $this->tag,
        ]);

        // Clear the input fields
        $this->reset('tag');

        $this->showEdit = false;
    }

    #[Computed]
    public function galleries()
    {
        return Gallery::all();
    }

    public function uploadImage(): void
    {
        $this->validate([
            'image' => 'required|image|max:2048', // Example validation rules for image upload
        ]);

        $imageName = 'Gallery-'.time().'.'.$this->image->extension();
        $this->image->storeAs('gallery', $imageName, 'local_files');

        Gallery::create([
            'image'  => $imageName,
            'tag'    => '',
            'status' => true,
        ]);

        // Clear the image input field
        $this->image = null;
    }

    public function removeImage($id): void
    {
        // Find and delete the gallery record by ID
        $gallery = Gallery::find($id);

        $gallery->delete();

        $this->reset();
    }

    #[Computed]
    public function services()
    {
        return Service::select('id', 'name')->get();
    }

    public function render()
    {
        return view('livewire.admin.gallery-manager');
    }
}
