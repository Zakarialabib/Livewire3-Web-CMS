<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /** @var array */
    protected $settings = [
        [
            'key'   => 'company_name',
            'value' => 'CorporateWeb',
        ],
        [
            'key'   => 'site_title',
            'value' => 'CorporateWeb',
        ],
        [
            'key'   => 'company_email_address',
            'value' => 'zakarialabib@gmail.com',
        ],
        [
            'key'   => 'company_phone',
            'value' => '+212638041919',
        ],
        [
            'key'   => 'company_address',
            'value' => 'Casablanca, Maroc',
        ],
        [
            'key'   => 'company_tax',
            'value' => '123456789',
        ],
        [
            'key'   => 'site_logo',
            'value' => 'logo.svg',
        ],
        [
            'key'   => 'site_favicon',
            'value' => '',
        ],
        [
            'key'   => 'footer_copyright_text',
            'value' => '',
        ],
        [
            'key'   => 'multi_language',
            'value' => true,
        ],
        [
            'key'   => 'seo_meta_title',
            'value' => 'CorporateWeb',
        ],
        [
            'key'   => 'seo_meta_description',
            'value' => 'CorporateWeb',
        ],
        [
            'key'   => 'social_facebook',
            'value' => 'https://www.facebook.com/zakaria.labiib/',
        ],
        [
            'key'   => 'social_twitter',
            'value' => 'https://twitter.com/zakarialabib',
        ],
        [
            'key'   => 'social_tiktok',
            'value' => '#',
        ],
        [
            'key'   => 'social_instagram',
            'value' => '#',
        ],
        [
            'key'   => 'social_linkedin',
            'value' => 'https://www.linkedin.com/in/zakaria-labib/',
        ],
        [
            'key'   => 'social_whatsapp',
            'value' => '#',
        ],
        [
            'key'   => 'head_tags',
            'value' => '',
        ],
        [
            'key'   => 'body_tags',
            'value' => '',
        ],
        [
            'key'   => 'header_bg_color',
            'value' => '#ffffff',
        ],
        [
            'key'   => 'footer_bg_color',
            'value' => '#ffffff',
        ],
        [
            'key'   => 'site_maintenance_message',
            'value' => 'Site is under maintenance',
        ],
        [
            'key'   => 'whatsapp_custom_message',
            'value' => "Salam, J'ai une Question/Demande d'nformation",
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->settings as $index => $setting) {
            $result = Settings::create($setting);

            if ( ! $result) {
                $this->command->info("Insert failed at record $index.");

                return;
            }
        }
        $this->command->info('Inserted '.count($this->settings).' records');
    }
}
