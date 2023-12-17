<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Service;

use Livewire\Component;
use Illuminate\Contracts\View\View;

class Options extends Component
{
    public $options;

    public function updatedOptions($options): void
    {
        $options = [];

        foreach ($options as $option) {
            if (empty($option['type'])) {
                continue;
            }

            if (empty($option['value'])) {
                continue;
            }

            $this->options[] = $option;
        }

        $this->dispatch('optionUpdated', $this->options);
    }

    public function addOption(): void
    {
        $this->options[] = [
            'type'  => '',
            'value' => '',
        ];
    }

    public function removeOption($index): void
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }

    public function mount(): void
    {
        $this->options = [
            [
                'type'  => '',
                'value' => '',
            ],
        ];
    }

    public function render(): View
    {
        return view('livewire.admin.service.options');
    }
}
