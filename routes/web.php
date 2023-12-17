<?php

declare(strict_types=1);

use App\Http\Controllers\ErrorController;
use App\Http\Controllers\FrontController;
use App\Livewire\Front\DynamicPage;
use App\Livewire\Front\ServicePage;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

Route::post('/uploads', [UploadController::class, 'upload'])->name('upload');

Route::get('/optimize', [FrontController::class, 'optimize']);

Route::get('/{slug?}', DynamicPage::class)->name('front.dynamicPage');
Route::get('/activity/{slug}', ServicePage::class)->name('front.activityPage');

Route::get('/generate-sitemaps', [FrontController::class, 'generateSitemaps'])->name('generate-sitemaps');
Route::get('/lang/{lang}', [FrontController::class, 'changeLanguage'])->name('changelanguage');

// Route::fallback(function (Request $request) {
//     return app()->make(ErrorController::class)->notFound($request);
// });

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/custom/livewire/update', $handle);
});
