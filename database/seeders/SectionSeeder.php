<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $language = Language::where('is_default', true)->first();

        Section::insert([
            [
                'id'             => 1,
                'title'          => 'Welcome to',
                'image'          => uploadImage('images/sections', 640, 480),
                'featured_title' => 'CorporateWeb',
                'subtitle'       => 'CorporateWeb',
                'label'          => 'Read Moe',
                'link'           => 'https://github.com/zakarialabib',
                'description'    => 'Salam, Thank you for having this project on we welcome you with  a good heart',
                'status'         => '1',
                'bg_color'       => '#effaeb',
                'text_color'     => 'black',
                'position'       => '1',
                'language_id'    => $language->id,
                'type'           => 'home',
            ],
            [
                'id'             => 2,
                'title'          => 'About us',
                'image'          => uploadImage('images/sections', 640, 480),
                'featured_title' => 'CorporateWeb',
                'subtitle'       => 'CorporateWeb',
                'label'          => 'CorporateWeb',
                'link'           => 'https://github.com/zakarialabib',
                'description'    => 'Making the world a better place',
                'status'         => '1',
                'bg_color'       => '#effaeb',
                'text_color'     => 'black',
                'position'       => '1',
                'language_id'    => $language->id,
                'type'           => 'about',
            ],
            [
                'id'             => 3,
                'title'          => 'Contact',
                'image'          => uploadImage('images/sections', 640, 480),
                'featured_title' => 'CorporateWeb',
                'subtitle'       => 'CorporateWeb',
                'label'          => 'CorporateWeb',
                'link'           => 'https://github.com/zakarialabib',
                'description'    => 'Get in touch with us',
                'status'         => '1',
                'bg_color'       => '#effaeb',
                'text_color'     => 'black',
                'position'       => '1',
                'language_id'    => $language->id,
                'type'           => 'contact',
            ],
            [
                'id'             => 4,
                'title'          => 'Services',
                'image'          => uploadImage('images/sections', 640, 480),
                'featured_title' => 'CorporateWeb',
                'subtitle'       => 'We have a wide range of services.',
                'label'          => 'Read More',
                'link'           => 'https://github.com/zakarialabib',
                'description'    => ' Dev solutions, to serve small and large companies, we can facilitate the delivery of your projects from our many points.',
                'status'         => '1',
                'bg_color'       => '#effaeb',
                'text_color'     => 'black',
                'position'       => '1',
                'language_id'    => $language->id,
                'type'           => 'service',
            ],
        ]);
    }
}
