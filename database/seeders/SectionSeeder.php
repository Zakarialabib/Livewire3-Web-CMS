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
                'featured_title' => 'Polyafrique',
                'subtitle'       => 'Polyafrique',
                'label'          => 'Read Moe',
                'link'           => 'https://polyafrique.com/',
                'description'    => 'We provide polymer materials to the plastic industry, sourcing of raw materials in all over the world',
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
                'featured_title' => 'Polyafrique',
                'subtitle'       => 'Polyafrique',
                'label'          => 'Polyafrique',
                'link'           => 'https://polyafrique.com/',
                'description'    => 'We are a polymer distribution and negociation company, created in 2020 in Casablanca, to facilitate the sourcing of raw materials in Africa and all over the continents of the globe, polyethylene or polypropylene, granules or powder, and all that is polymers necessary for the industry of your plastic articles. ',
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
                'featured_title' => 'Polyafrique',
                'subtitle'       => 'Polyafrique',
                'label'          => 'Polyafrique',
                'link'           => 'https://polyafrique.com/',
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
                'featured_title' => 'Polyafrique',
                'subtitle'       => 'We have a wide range of services.',
                'label'          => 'Read More',
                'link'           => 'https://polyafrique.com/',
                'description'    => ' Commercial and logistical solutions, to serve small and large companies, we can facilitate the delivery of your order from our many points of sale and storage over the globe.',
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
