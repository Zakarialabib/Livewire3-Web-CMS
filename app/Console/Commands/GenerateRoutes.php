<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;

class GenerateRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:routes';
    protected $description = 'Generate route definitions based on Livewire index files';

    public function handle()
    {
        try {
            $livewireDirectories = glob('app/Livewire/*', GLOB_ONLYDIR);
            $routeDefinitions = '';

            foreach ($livewireDirectories as $directory) {
                $livewireFiles = glob($directory.'/Index.php');

                foreach ($livewireFiles as $file) {
                    $className = 'App\\Livewire\\'.basename($directory).'\\Index';
                    $routePath = strtolower(basename($directory));
                    $routeDefinitions .= "- Route::get('$routePath', $className::class);\n";
                }
            }

            // Include Livewire files inside the "admin" and "front" folders
            $adminLivewireFiles = glob('app/Livewire/Admin/*');

            foreach ($adminLivewireFiles as $file) {
                $className = 'App\\Livewire\\Admin\\'.basename($file, '.php');
                $routePath = 'admin/'.strtolower(basename($file, '.php'));
                $routeDefinitions .= "- Route::get('$routePath', $className::class);\n";
            }

            $frontLivewireFiles = glob('app/Livewire/Front/*');

            foreach ($frontLivewireFiles as $file) {
                $className = 'App\\Livewire\\Front\\'.basename($file, '.php');
                $routePath = 'front/'.strtolower(basename($file, '.php'));
                $routeDefinitions .= "- Route::get('$routePath', $className::class);\n";
            }

            file_put_contents(base_path('public/docs/routes.md'), $routeDefinitions);

            $this->info('Routes generated successfully!');

            return 0; // Command executed successfully
        } catch (Exception $e) {
            $this->error('An error occurred: '.$e->getMessage());

            return 1; // Command failed
        }
    }
}
