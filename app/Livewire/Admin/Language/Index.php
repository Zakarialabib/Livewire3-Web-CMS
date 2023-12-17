<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Language;

use Livewire\Component;
use App\Models\Language;
use Illuminate\Support\Facades\Artisan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.dashboard')]
class Index extends Component
{
    use LivewireAlert;

    public $languages = [];

    public $language;

    public function mount(): void
    {
        $this->languages = Language::all()->toArray();
    }

    public function render()
    {
        return view('livewire.admin.language.index');
    }

    public function onSetDefault($id): void
    {
        Language::where('is_default', '=', true)->update(['is_default' => false]);

        $this->language = Language::findOrFail($id);

        $this->language->is_default = true;

        $this->language->save();

        $this->mount();

        $this->alert('success', __('Language updated successfully!'));
    }

    public function sync($id): void
    {
        $languages = Language::findOrFail($id);

        Artisan::call('translatable:export', ['lang' => $languages->code]);

        $this->alert('success', __('Translation updated successfully!'));
    }

    public function delete(Language $language): void
    {
        $language->delete();

        $this->alert('warning', __('Language deleted successfully!'));
    }
}
