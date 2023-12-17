<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        Page::factory(6)->create();
    }
}
