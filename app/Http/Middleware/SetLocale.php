<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use App\Models\Language;
use App\Helpers;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        if (Helpers::settings('multi_language')) {
            $locale = Session::get('language');

            if ( ! $locale) {
                $defaultLanguage = Cache::rememberForever('default_language', function () {
                    return Language::where('is_default', true)->value('code');
                });

                $locale = $defaultLanguage ?? config('app.locale');
                Session::put('language', $locale);
            }

            app()->setLocale($locale);
        } else {
            // If multi_language is false, set the locale to the default language directly
            $defaultLanguage = Cache::rememberForever('default_language', function () {
                return Language::where('is_default', true)->value('code');
            });

            app()->setLocale($defaultLanguage ?? config('app.locale'));
        }

        return $next($request);
    }
}
