<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SettingController;
use App\Livewire\Admin\Contacts;
use App\Livewire\Admin\Language\EditTranslation;
use App\Livewire\Admin\Role\Index as RoleIndex;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Page\Index as PageIndex;
use App\Livewire\Admin\Page\Settings as PageSettings;
use App\Livewire\Admin\Page\Edit as EditPage;
use App\Livewire\Admin\Page\Create as CreatePage;
use App\Livewire\Admin\Language\Index as LanguageIndex;
use App\Livewire\Admin\Slider\Index as SliderIndex;
use App\Livewire\Admin\Section\Index as SectionIndex;
use App\Livewire\Admin\Users\Index as UserIndex;
use App\Livewire\Admin\Blog\Index as BlogIndex;
use App\Livewire\Admin\BlogCategory\Index as BlogCategoryIndex;
use App\Livewire\Admin\Service\Index as ServiceIndex;
use App\Livewire\Admin\Menu\Index as MenuIndex;
use App\Livewire\Admin\Subscriber\Index as SubscriberIndex;
use App\Livewire\Admin\GalleryManager;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:admin']], function () {
    // Dashboard
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // Contact
    Route::get('/contact', Contacts::class)->name('contacts');

    // Sliders
    Route::get('/sliders', SliderIndex::class)->name('sliders');

    // Pages
    Route::get('/pages', PageIndex::class)->name('pages');
    Route::get('/page/create', CreatePage::class)->name('page.create');
    Route::get('/page/{id}/edit', EditPage::class)->name('page.edit');
    Route::get('/page/settings', PageSettings::class)->name('page.settings');
    // Blogs
    Route::get('/blogs', BlogIndex::class)->name('blogs.index');

    // Bcategories
    Route::get('/blog-categories', BlogCategoryIndex::class)->name('blog-categories.index');

    // Languages
    Route::get('/langs', LanguageIndex::class)->name('langs.index');
    Route::get('/translation/{id}', EditTranslation::class)->name('translation');

    // Service
    Route::get('/services', ServiceIndex::class)->name('services');

    // Sections
    Route::get('/sections', SectionIndex::class)->name('sections');

    Route::get('/gallery', GalleryManager::class)->name('gallery');

    Route::get('/subscribers', SubscriberIndex::class)->name('subscribers');
    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::get('/roles', RoleIndex::class)->name('roles');

    // Users
    Route::get('users', UserIndex::class)->name('users.index');

    // Setting
    Route::get('/redirects', [SettingController::class, 'redirects'])->name('setting.redirects');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/menu-settings', MenuIndex::class)->name('menu-settings.index');
});
