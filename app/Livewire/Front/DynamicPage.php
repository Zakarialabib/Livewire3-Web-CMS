<?php

declare(strict_types=1);

namespace App\Livewire\Front;

use App\Enums\PageType;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\Page;
use App\Models\PageSetting;
use Livewire\Component;
use App\Traits\LazySpinner;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use App\Livewire\Utils\WithModels;

#[Layout('components.layouts.guest')]
class DynamicPage extends Component
{
    use LazySpinner;
    use WithModels;

    public Page $page;

    public $section;

    public string $description;

    public $type;

    public $tag;

    public $pageSetting;

    public $settings;

    public $pageType;

    public $item_id;

    public $layout_config;

    public function mount(?string $slug = 'home'): void
    {
        $this->page = Page::where('slug', $slug)->firstOrFail();
        $this->type = $this->page->type;
        $this->description = $this->page->description;

        if (is_string($this->page->settings)) {
            $this->settings = json_decode((string) $this->page->settings, true);
        } elseif (is_array($this->page->settings)) {
            $this->settings = $this->page->settings;
        }

        $this->pageSetting = PageSetting::where('page_id', $this->page->id)
            ->first();

        if ( ! $this->pageSetting) {
            return;
        }

        if ( ! $this->pageSetting->layout_config) {
            return;
        }

        $this->layout_config = json_decode((string) $this->pageSetting->layout_config, true);
    }

    public function selectedTag($tag): void
    {
        $this->tag = $tag;
    }

    #[Computed]
    public function gallerySection()
    {
        return Gallery::where('status', true)
            ->when($this->tag, function ($query): void {
                $query->where('tag', $this->tag);
            })->get();
    }

    #[Computed]
    public function services()
    {
        return Service::query()->get();
    }

    #[Computed]
    public function aboutSection()
    {
        return $this->getSectionByType(PageType::ABOUT);
    }

    #[Computed]
    public function contactSection()
    {
        return $this->getSectionByType(PageType::CONTACT);
    }

    public function render()
    {
        return view('livewire.front.dynamic-page');
    }
}
