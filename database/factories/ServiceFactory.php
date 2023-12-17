<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $language = Language::where('is_default', true)->first();

        return [
            'title'       => fake()->name(),
            'slug'        => Str::slug(fake()->name()),
            'type'        => null,
            'image'       => 'image.jpg',
            'content'     => fake()->sentence(),
            'status'      => 1,
            'features'    => null,
            'options'     => null,
            'language_id' => $language->id,
        ];
    }
}
