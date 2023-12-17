<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $language = Language::where('is_default', true)->first();

        $services = [
            [
                'title'       => 'Service 1',
                'slug'        => 'service-1',
                'type'        => null,
                'image'       => 'service.jpg',
                'content'     => 'High quality service , made from the some out of space. It is a strong, durable, and lightweight.',
                'status'      => 1,
                'features'    => null,
                'options'     => null,
                'language_id' => $language->id,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
