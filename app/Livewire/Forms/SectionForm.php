<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Models\Section;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Livewire\WithFileUploads;

class SectionForm extends Form
{
    use WithFileUploads;

    public ?Section $section;

    #[Rule('required', 'max:255')]
    public $title;

    #[Rule('nullable', 'max:255')]
    public $subtitle;

    #[Rule('required|min:3')]
    public $description;

    #[Rule('nullable|string ')]
    public $link;

    #[Rule('nullable|string|max:255 ')]
    public $label;

    #[Rule('nullable|string|max:50')]
    public $bg_color;

    #[Rule('required')]
    public $type;

    #[Rule('nullable|integer|exists:pages,id')]
    public $page_id;

    #[Rule('nullable')]
    public $image;

    public function setPost(Section $section): void
    {
        $this->section = $section;

        $this->title = $section->title;

        $this->description = $section->description;

        $this->subtitle = $section->subtitle;

        $this->link = $section->link;

        $this->label = $section->label;

        $this->bg_color = $section->bg_color;

        $this->type = $section->type;

        $this->page_id = $section->page_id;

        $this->image = $section->image;
    }

    public function store(): void
    {
        if ($this->image) {
            $fileName = $this->title.'.'.$this->image->extension();
            $this->image->storeAs('sections', $fileName);
            $this->image = $fileName;
        }

        Section::create($this->all());
    }

    public function update(): void
    {
        $validatedData = $this->validate();
        $this->section->update($validatedData);
    }
}
