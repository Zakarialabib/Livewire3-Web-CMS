<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $language = Language::where('is_default', true)->first();

        Slider::insert([
            [
                'subtitle'    => fake()->sentence(3),
                'title'       => fake()->sentence(2),
                'description' => fake()->paragraph(3),
                'image'       => uploadImage('images/sliders', 1640, 1480),
                'bg_color'    => 'bg-white',
                'featured'    => 1,
                'link'        => 'https://www.polyafrique.com',
                'language_id' => $language->id,
            ],
            [
                'subtitle'    => fake()->sentence(3),
                'title'       => fake()->sentence(2),
                'description' => fake()->paragraph(3),
                'image'       => uploadImage('images/sliders', 1640, 1480),
                'bg_color'    => 'bg-white',
                'featured'    => 0,
                'link'        => 'https://www.polyafrique.com',
                'language_id' => $language->id,
            ],
            [
                'subtitle'    => fake()->sentence(3),
                'title'       => fake()->sentence(2),
                'description' => fake()->paragraph(3),
                'image'       => uploadImage('images/sliders', 1640, 1480),
                'bg_color'    => 'bg-white',
                'featured'    => 0,
                'link'        => 'https://www.polyafrique.com',
                'language_id' => $language->id,
            ],
        ]);
    }
}
