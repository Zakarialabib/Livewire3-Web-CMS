<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        $this->call([
            LanguagesSeeder::class,
            SettingSeeder::class,
            SectionSeeder::class,
            PageSeeder::class,
            MenuSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            BlogSeeder::class,
            SliderSeeder::class,
            ServiceSeeder::class,
            // PartnerSeeder::class,
        ]);
    }
}
