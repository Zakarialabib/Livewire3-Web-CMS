<?php

declare(strict_types=1);

namespace App\Livewire\Front;

use App\Livewire\Utils\WithModels;
use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.guest')]
class ServicePage extends Component
{
    use WithModels;
    public $service;

    public $page;

    public $pageSetting;

    public $section;

    public $layout_config;

    public function mount($slug): void
    {
        $this->service = Service::where('slug', $slug)
            ->firstOrFail();

        $this->pageSetting = $this->getConfig('service_page', $this->service->id);

        if ($this->pageSetting) {
            $this->layout_config = json_decode((string) $this->pageSetting->layout_config, true);
        }
    }

    private function getConfig(string $type, $id)
    {
        return match ($type) {
            'section' => $this->getPageConfig($id),
            'service' => $this->getServiceConfig($id),
            default   => $this->getPageTypeConfig($type),
        };
    }

    public function render()
    {
        return view('livewire.front.service-page');
    }
}
