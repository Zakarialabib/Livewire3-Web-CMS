<?php

declare(strict_types=1);

namespace App;

use App\Enums\MenuPlacement;
use App\Models\Menu;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Section;
use App\Models\Settings;
use Illuminate\Support\Facades\Cache;

class Helpers
{
    /**
     * Fetch Cached settings from database
     *
     * @param mixed $key
     *
     * @return mixed
     */
    public static function settings($key)
    {
        return Cache::rememberForever('settings', function () {
            return Settings::pluck('value', 'key');
        })->get($key);
    }

    public static function getActivePages()
    {
        return Page::active()
            ->select('id', 'title', 'slug')
            ->limit(4)
            ->get();
    }

    public static function getHeaderMenu()
    {
        return Menu::where('placement', MenuPlacement::HEADER)
            ->with('parent', 'children')
            ->orderBy('sort_order')
            ->get();
    }

    public static function getFooterSection1Menu()
    {
        return Menu::where('placement', MenuPlacement::FOOTER_SECTION_1)
            ->orderBy('sort_order')
            ->get();
    }

    public static function getFooterSection2Menu()
    {
        return Menu::where('placement', MenuPlacement::FOOTER_SECTION_2)
            ->orderBy('sort_order')
            ->get();
    }

    public static function getHeaderMobileMenu()
    {
        return Menu::where('placement', MenuPlacement::MOBILE_HEADER)
            ->orderBy('sort_order')
            ->get();
    }

    public static function getSidebarMenu()
    {
        return Menu::where('placement', MenuPlacement::SIDEBAR)
            ->orderBy('sort_order')
            ->get();
    }

    public static function getSectionByCategory($page_id)
    {
        return Section::where('page_id', $page_id)
            ->orderBy('position')
            ->get();
    }

    public static function getGalleries()
    {
        return Gallery::select('tag', 'id')
            ->get();
    }

    public static function getSectionByType($type)
    {
        return Section::where('type', $type)->active()->first();
    }

    public static function getSectionTitle($id)
    {
        $section = Section::where('id', $id)->first();

        if ($section) {
            return $section->title;
        }

        return '';
    }

    public static function getSection($id)
    {
        $section = Section::where('id', $id)->first();

        if ($section) {
            return $section;
        }

        return '';
    }
}
