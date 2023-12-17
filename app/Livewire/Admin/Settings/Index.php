<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Settings;

use App\Helpers;
use App\Models\Settings;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $company_name;

    public $site_title;

    public $logoFile;

    public $iconFile;

    public $favicon;

    public $siteImage;

    public $company_email_address;

    public $company_phone;

    public $company_address;

    public $company_tax;

    public $social_facebook;

    public $social_twitter;

    public $social_tiktok;

    public $social_instagram;

    public $social_linkedin;

    public $social_whatsapp;

    public $head_tags;

    public $body_tags;

    public $multi_language;

    public $seo_meta_title;

    public $seo_meta_description;

    public $footer_copyright_text;

    public $header_bg_color;

    public $footer_bg_color;

    public $site_maintenance_message;

    public $whatsapp_custom_message;

    protected $listeners = ['uploadFavicon', 'uploadLogo'];

    public function mount(): void
    {
        $this->company_name = Helpers::settings('company_name');
        $this->site_title = Helpers::settings('site_title');
        $this->company_email_address = Helpers::settings('company_email_address');
        $this->company_phone = Helpers::settings('company_phone');
        $this->company_address = Helpers::settings('company_address');
        $this->company_tax = Helpers::settings('company_tax');
        $this->siteImage = Helpers::settings('site_logo');
        $this->favicon = Helpers::settings('site_favicon');
        $this->social_facebook = Helpers::settings('social_facebook');
        $this->social_twitter = Helpers::settings('social_twitter');
        $this->social_tiktok = Helpers::settings('social_tiktok');
        $this->social_instagram = Helpers::settings('social_instagram');
        $this->social_linkedin = Helpers::settings('social_linkedin');
        $this->social_whatsapp = Helpers::settings('social_whatsapp');
        $this->head_tags = Helpers::settings('head_tags');
        $this->body_tags = Helpers::settings('body_tags');
        $this->multi_language = Helpers::settings('multi_language');
        $this->seo_meta_title = Helpers::settings('seo_meta_title');
        $this->seo_meta_description = Helpers::settings('seo_meta_description');
        $this->footer_copyright_text = Helpers::settings('footer_copyright_text');
        $this->header_bg_color = Helpers::settings('header_bg_color');
        $this->footer_bg_color = Helpers::settings('footer_bg_color');
        $this->site_maintenance_message = Helpers::settings('site_maintenance_message');
        $this->whatsapp_custom_message = Helpers::settings('whatsapp_custom_message');
    }

    public function store(): void
    {
        $settings = [
            'company_name'             => $this->company_name,
            'site_title'               => $this->site_title,
            'company_email_address'    => $this->company_email_address,
            'company_phone'            => $this->company_phone,
            'company_address'          => $this->company_address,
            'company_tax'              => $this->company_tax,
            'social_facebook'          => $this->social_facebook,
            'social_twitter'           => $this->social_twitter,
            'social_tiktok'            => $this->social_tiktok,
            'social_instagram'         => $this->social_instagram,
            'social_linkedin'          => $this->social_linkedin,
            'social_whatsapp'          => $this->social_whatsapp,
            'head_tags'                => $this->head_tags,
            'body_tags'                => $this->body_tags,
            'multi_language'           => $this->multi_language,
            'seo_meta_title'           => $this->seo_meta_title,
            'seo_meta_description'     => $this->seo_meta_description,
            'footer_copyright_text'    => $this->footer_copyright_text,
            'header_bg_color'          => $this->header_bg_color,
            'footer_bg_color'          => $this->footer_bg_color,
            'site_maintenance_message' => $this->site_maintenance_message,
            'whatsapp_custom_message'  => $this->whatsapp_custom_message,
        ];

        foreach ($settings as $key => $value) {
            Settings::set($key, $value);
        }

        $this->alert('success', __('Settings updated successfully!'));
    }

    public function render()
    {
        return view('livewire.admin.settings.index');
    }

    public function uploadFavicon(): void
    {
        $favicon = $this->upload($this->iconFile, 'favicon', 'iconFile');

        if ($favicon) {
            Settings::set('site_favicon', $favicon);
            $this->alert('success', __('Favicon updated successfully!'));
            $this->iconFile = '';
            $this->favicon = $favicon;
        } else {
            $this->alert('error', __('Unable to upload your image'));
        }
    }

    public function uploadLogo(): void
    {
        $logo = $this->upload($this->logoFile, 'logo', 'logoFile');

        if ($logo) {
            Settings::set('site_logo', $logo);
            $this->alert('success', __('Logo updated successfully!'));
            $this->logoFile = '';
            $this->siteImage = $logo;
        } else {
            $this->alert('error', __('Unable to upload your image'));
        }
    }

    private function upload($filename, ?string $name, string $validateName)
    {
        $this->validate([
            $validateName => 'required|mimes:jpeg,png,jpg,gif,svg,ico|max:1048',
        ]);

        if ($name !== null) {
            $path = public_path().'/images/'.basename($name);
            Storage::delete($path);
        }

        return $filename->storeAs($name.'.'.$filename->extension());
    }
}
