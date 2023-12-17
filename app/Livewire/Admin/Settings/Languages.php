<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

use App\Models\Language;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Languages extends Component
{
    use LivewireAlert;

    public $languages = [];

    protected $listeners = ['sendUpdateLanguageStatus' => 'onUpdateLanguageStatus', 'sync'];

    public function mount(): void
    {
        $this->languages = Language::all()->toArray();
    }

    public function render()
    {
        return view('livewire.translations');
    }

    public function onSetDefault($id): void
    {
        try {
            Language::where('is_default', '=', true)->update(['is_default' => false]);
            $trans = Language::findOrFail($id);
            $trans->is_default = true;
            $trans->updated_at = new DateTime();
            $trans->save();

            $this->alert('success', __('Language updated successfully!'));
            $this->mount();
        } catch (Exception $exception) {
            $this->alert('error', __($exception->getMessage()));
        }
    }

    /**
     * -------------------------------------------------------------------------------
     *  Sync Translations
     * -------------------------------------------------------------------------------
     */
    public function sync($id): void
    {
        $languages = Language::findOrFail($id);

        Artisan::call('translatable:export', ['lang' => $languages->code]);

        $this->alert('success', __('Translation updated successfully!'));
    }

    public function onUpdateLanguageStatus(): void
    {
        $this->mount();
    }

    /**
     * -------------------------------------------------------------------------------
     *  Delete Language
     * -------------------------------------------------------------------------------
     */
    public function delete(Language $lang_id): void
    {
        $lang_id->delete();

        $this->alert('warning', __('Language deleted successfully!'));
    }
}
