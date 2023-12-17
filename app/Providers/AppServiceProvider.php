<?php

declare(strict_types=1);

namespace App\Providers;

use App\Helpers;
use App\Models\Language;
use App\Models\Contact;
use App\Models\Subscriber;
use App\Models\Settings;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Observers\SettingsObserver;
use App\Observers\ContactObserver;
use App\Observers\SubscriberObserver;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        if (Helpers::settings('multi_language')) {
            View::share('languages', $this->getLanguages());
        } else {
            // If multi_language is false, provide the default language directly
            View::share('languages', [$this->getDefaultLanguage()]);
        }

        Settings::observe(SettingsObserver::class);
        Contact::observe(ContactObserver::class);
        Subscriber::observe(SubscriberObserver::class);

        Factory::macro('getImageUrl', function ($path, int $width, int $height): string {
            $filename = Str::random(12).'.jpg'; // You can adjust the filename format if needed

            // Generate the full path to save the image
            $imagePath = $path.'/'.$filename;

            $imageUrl = 'https://picsum.photos/'.$width.'/'.$height.'/';

            // Save the image to the local filesystem

            file_put_contents($imagePath, file_get_contents($imageUrl));

            return $filename;
        });

        // Model::shouldBeStrict(! $this->app->isProduction());
    }

    private function getLanguages()
    {
        return Cache::rememberForever('languages', function () {
            return Language::pluck('name', 'code')->toArray();
        });
    }

    private function getDefaultLanguage()
    {
        return Language::where('is_default', true)->pluck('name', 'code')->toArray();
    }
}
