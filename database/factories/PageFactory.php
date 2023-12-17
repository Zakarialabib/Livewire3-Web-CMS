<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PageSetting;
use App\Models\Page;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $pageType = $this->faker->randomElement(['home', 'about', 'contact']);

        $language = Language::where('is_default', true)->first();

        return [
            'title'            => $pageType,
            'slug'             => $pageType,
            'description'      => json_encode(['text' => $this->faker->paragraph]),
            'image'            => $this->faker->imageUrl(),
            'type'             => $pageType,
            'meta_title'       => $this->faker->sentence,
            'meta_description' => $this->faker->sentence,
            'language_id'      => $language->id,
            'status'           => $this->faker->boolean ? 1 : 0, // 1 for true, 0 for false
            'settings'         => json_encode([
                'is_title'       => true,
                'is_image'       => true,
                'is_description' => true,
                'is_sliders'     => true,
                'is_gallery'     => false,
                'is_offer'       => true,
                'is_services'    => true,
                'is_contact'     => true,
                'is_partners'    => true,
                'is_about'       => true,
            ], JSON_THROW_ON_ERROR),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Page $page) {
            // Create PageSettings for each page
            PageSetting::factory()->create([
                // 'page_id' => $page->id,
                'page_type' => $this->faker->randomElement(['home', 'about', 'contact', ]),
                // Set other PageSettings attributes here
                'status'        => $this->faker->boolean,
                'layout_type'   => $this->faker->randomElement(['row', 'col', 'wrap']),
                'layout_config' => json_encode([
                    [
                        'type'  => $this->faker->randomElement(['section', 'contact', 'about']),
                        'order' => $this->faker->randomElement(['0', '1', '2', '3', '4', '5', '10', '15', '25', '50', '75', '100']),
                        // item id is the id of the item in the database
                        'item_id' => '', // You might want to set this to a valid ID if it's not meant to be empty.
                        // item config is the config if the item doesn't have infos
                        'item_config' => [
                            'title'       => $this->faker->sentence,
                            'description' => $this->faker->paragraph,
                            'link_text'   => 'Learn More',
                            'link'        => $this->faker->url,
                            'icon'        => $this->faker->randomElement(['fas fa-home', 'fas fa-user', 'fas fa-cog', 'fas fa-envelope', 'fas fa-phone', 'fas fa-map-marker-alt']),
                            'status'      => $this->faker->boolean,
                        ],
                        // item style is the style of the item
                        'item_style' => [
                            'width'            => $this->faker->randomElement(['25', '50', '75', '100']),
                            'height'           => $this->faker->randomElement(['25', '50', '75', '100']),
                            'background_color' => $this->faker->hexColor,
                            'text_color'       => $this->faker->hexColor,
                            'font_size'        => $this->faker->randomElement(['xs', 'sm', 'base', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '9xl']),
                            'padding'          => $this->faker->randomElement(['0', '1', '2', '3', '4', '5', '10', '15']),
                            'margin'           => $this->faker->randomElement(['0', '1', '2', '3', '4', '5', '10', '15']),
                            'border'           => [
                                'width' => $this->faker->randomElement(['0', '1', '2', '3', '4', '5', '10']),
                                'color' => $this->faker->hexColor,
                                'style' => $this->faker->randomElement(['solid', 'dashed', 'dotted', 'double', 'groove', 'ridge', 'inset', 'outset', 'none']),
                            ],
                            'border_radius' => $this->faker->randomElement(['0', '1', '2', '3', '4', '5', '10', '15', '25', '50', '75', '100']),
                            'box_shadow'    => $this->faker->randomElement(['0', '1', '2', '3', '4', '5', '10', '15', '25', '50', '75', '100']),
                            'status'        => $this->faker->boolean,
                        ],
                    ],
                    [
                        'type'  => $this->faker->randomElement(['section', 'activity', 'package', 'workshop', 'contact', 'about']),
                        'order' => $this->faker->randomElement(['0', '1', '2', '3', '4', '5', '10', '15', '25', '50', '75', '100']),
                        // item id is the id of the item in the database
                        'item_id' => '', // You might want to set this to a valid ID if it's not meant to be empty.
                        // item config is the config if the item doesn't have infos
                        'item_config' => [
                            'title'       => $this->faker->sentence,
                            'description' => $this->faker->paragraph,
                            'link_text'   => 'Learn More',
                            'link'        => $this->faker->url,
                            'icon'        => $this->faker->randomElement(['fas fa-home', 'fas fa-user', 'fas fa-cog', 'fas fa-envelope', 'fas fa-phone', 'fas fa-map-marker-alt']),
                            'status'      => $this->faker->boolean,
                        ],
                        // item style is the style of the item
                        'item_style' => [
                            'width'            => $this->faker->randomElement(['25', '50', '75', '100']),
                            'height'           => $this->faker->randomElement(['25', '50', '75', '100']),
                            'background_color' => $this->faker->hexColor,
                            'text_color'       => $this->faker->hexColor,
                            'font_size'        => $this->faker->randomElement(['xs', 'sm', 'base', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '9xl']),
                            'padding'          => $this->faker->randomElement(['0', '1', '2', '3', '4', '5', '10', '15', '25', '50', '75', '100']),
                            'margin'           => $this->faker->randomElement(['0', '1', '2', '3', '4', '5', '10', '15', '25', '50', '75', '100']),
                            'border'           => [
                                'width' => $this->faker->randomElement(['0', '1', '2', '3', '4', '5', '10', '15', '25', '50', '75', '100']),
                                'color' => $this->faker->hexColor,
                                'style' => $this->faker->randomElement(['solid', 'dashed', 'dotted', 'double', 'groove', 'ridge', 'inset', 'outset', 'none']),
                            ],
                            'border_radius' => $this->faker->randomElement(['0', '1', '2', '3', '4', '5', '10', '15', '25', '50', '75', '100']),
                            'box_shadow'    => $this->faker->randomElement(['0', '1', '2', '3', '4', '5', '10', '15', '25', '50', '75', '100']),
                            'status'        => $this->faker->boolean,
                        ],
                    ],
                ]),
            ]);
        });
    }
}
