<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\MenuPlacement;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'name'       => 'Home',
            'label'      => 'Home',
            'url'        => '/',
            'type'       => 'link',
            'placement'  => MenuPlacement::HEADER,
            'sort_order' => 1,
            'parent_id'  => null,
            'new_window' => false,
        ]);

        Menu::create([
            'name'       => 'contact',
            'label'      => 'contact',
            'url'        => '/',
            'type'       => 'link',
            'placement'  => MenuPlacement::HEADER,
            'sort_order' => 1,
            'parent_id'  => null,
            'new_window' => false,
        ]);

        Menu::create([
            'name'       => 'About',
            'label'      => 'About',
            'url'        => '/about',
            'type'       => 'link',
            'placement'  => MenuPlacement::HEADER,
            'sort_order' => 2,
            'parent_id'  => null,
            'new_window' => false,
        ]);

        Menu::create([
            'name'       => 'Home',
            'label'      => 'Home',
            'url'        => '/',
            'type'       => 'link',
            'placement'  => MenuPlacement::FOOTER_SECTION_1,
            'sort_order' => 1,
            'parent_id'  => null,
            'new_window' => false,
        ]);

        Menu::create([
            'name'       => 'contact',
            'label'      => 'contact',
            'url'        => '/',
            'type'       => 'link',
            'placement'  => MenuPlacement::FOOTER_SECTION_1,
            'sort_order' => 1,
            'parent_id'  => null,
            'new_window' => false,
        ]);

        Menu::create([
            'name'       => 'About',
            'label'      => 'About',
            'url'        => '/about',
            'type'       => 'link',
            'placement'  => MenuPlacement::FOOTER_SECTION_1,
            'sort_order' => 2,
            'parent_id'  => null,
            'new_window' => false,
        ]);
    }
}
