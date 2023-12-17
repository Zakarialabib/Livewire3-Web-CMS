<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Throwable;

class FrontController extends Controller
{
    //Optimization page
    public function optimize()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        return back();
    }

    public function changeLanguage($lang)
    {
        $availableLanguages = cache()->get('languages'); // Retrieve the available languages from cache

        if (array_key_exists($lang, $availableLanguages)) {
            Session::put('language', $lang);
        }

        return redirect()->back();
    }

    public function generateSitemaps()
    {
        try {
            Artisan::call('generate:sitemap');

            Log::info('Sitemap completed successfully!');

            return back();
        } catch (Throwable $throwable) {
            Log::info('Backup failed!', ['error' => $throwable->getMessage()]);

            return back();
        }
    }
}
