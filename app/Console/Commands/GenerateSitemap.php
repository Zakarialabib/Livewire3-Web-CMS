<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Page;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    public function handle()
    {
        // Create a new SitemapIndex
        $sitemapIndex = SitemapIndex::create();

        // Create the directory if it doesn't exist
        if ( ! file_exists(public_path('sitemap'))) {
            mkdir(public_path('sitemap'), 0775, true);
        }

        // Generate sitemap for dynamic pages and add it to the index
        $dynamicPagesSitemap = $this->pages();
        $sitemapIndex->add($dynamicPagesSitemap);

        // Generate sitemap for activity pages and add it to the index
        $activityPagesSitemap = $this->activityPages();
        $sitemapIndex->add($activityPagesSitemap);

        // Generate sitemap for workshop pages and add it to the index
        $workshopPagesSitemap = $this->workshopPages();
        $sitemapIndex->add($workshopPagesSitemap);

        // Generate sitemap for package pages and add it to the index
        $packagePagesSitemap = $this->packagePages();
        $sitemapIndex->add($packagePagesSitemap);

        // Write the sitemap index to a file
        $sitemapIndex->writeToFile(public_path('sitemap/sitemap_index.xml'));

        $this->info('Sitemap has been generated.');
    }

    public function pages(): string
    {
        // Specify the filename for the sitemap
        $sitemapName = 'pages.xml';

        // Create a new Sitemap
        $sitemap = Sitemap::create();

        // Add the dynamic page route to the sitemap
        $url = '/';
        $sitemap->add(Url::create($url)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY) // Example: set to daily
            ->setPriority(1)); // Example: set priority to 1

        // Write the sitemap to a file
        $sitemap->writeToFile(public_path('sitemap/'.$sitemapName));

        return $sitemapName;
    }

    public function activityPages(): string
    {
        // Fetch all activity pages from the database
        $pages = Page::where('type', 'activity')->get();

        // Specify the filename for the sitemap
        $sitemapName = 'activity_pages.xml';

        // Create a new Sitemap
        $sitemap = Sitemap::create();

        // Loop through all activity pages and add them to the sitemap
        foreach ($pages as $page) {
            $url = 'activity/'.$page->slug;
            $sitemap->add(Url::create($url)
                ->setLastModificationDate($page->updated_at ?? now()) // use updated_at or current time
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY) // Example: set to monthly
                ->setPriority(0.8)); // Example: set priority to 0.8
        }

        // Write the sitemap to a file
        $sitemap->writeToFile(public_path('sitemap/'.$sitemapName));

        return $sitemapName;
    }

    public function workshopPages(): string
    {
        // Fetch all workshop pages from the database
        $pages = Page::where('type', 'workshop')->get();

        // Specify the filename for the sitemap
        $sitemapName = 'workshop_pages.xml';

        // Create a new Sitemap
        $sitemap = Sitemap::create();

        // Loop through all workshop pages and add them to the sitemap
        foreach ($pages as $page) {
            $url = 'workshop/'.$page->slug;
            $sitemap->add(Url::create($url)
                ->setLastModificationDate($page->updated_at ?? now()) // use updated_at or current time
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY) // Example: set to monthly
                ->setPriority(0.8)); // Example: set priority to 0.8
        }

        // Write the sitemap to a file
        $sitemap->writeToFile(public_path('sitemap/'.$sitemapName));

        return $sitemapName;
    }

    public function packagePages(): string
    {
        // Fetch all package pages from the database
        $pages = Page::where('type', 'package')->get();

        // Specify the filename for the sitemap
        $sitemapName = 'package_pages.xml';

        // Create a new Sitemap
        $sitemap = Sitemap::create();

        // Loop through all package pages and add them to the sitemap
        foreach ($pages as $page) {
            $url = 'package/'.$page->slug;
            $sitemap->add(Url::create($url)
                ->setLastModificationDate($page->updated_at ?? now()) // use updated_at or current time
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY) // Example: set to monthly
                ->setPriority(0.8)); // Example: set priority to 0.8
        }

        // Write the sitemap to a file
        $sitemap->writeToFile(public_path('sitemap/'.$sitemapName));

        return $sitemapName;
    }
}
