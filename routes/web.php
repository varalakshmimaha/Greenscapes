<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceSubCategoryController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TeamCategoryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Frontend\HomeController;

// ========================
// Frontend Routes
// ========================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/services/{slug}', [HomeController::class, 'serviceDetail'])->name('service.detail');
Route::get('/projects', [HomeController::class, 'projects'])->name('projects');
Route::get('/projects/{slug}', [HomeController::class, 'projectDetail'])->name('project.detail');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs');
Route::get('/testimonials', [HomeController::class, 'testimonials'])->name('testimonials');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');

// ========================
// Admin Auth Routes
// ========================
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    Route::get('/forgot-password', [AdminLoginController::class, 'showForgotForm'])->name('admin.password.request');
    Route::post('/forgot-password', [AdminLoginController::class, 'sendResetLink'])->name('admin.password.email');
});

// ========================
// Admin Panel Routes (Protected)
// ========================
Route::prefix('admin')->name('admin.')->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Banners
    Route::resource('banners', BannerController::class);

    // Navigation Menus
    Route::resource('menus', MenuController::class);
    Route::post('menus/update-order', [MenuController::class, 'updateOrder'])->name('menus.updateOrder');

    // About Us
    Route::resource('about', AboutController::class);

    // Team Categories & Members
    Route::resource('team-categories', TeamCategoryController::class);
    Route::resource('team', TeamController::class);

    // Service Categories & Sub Categories
    Route::resource('service-categories', ServiceCategoryController::class);
    Route::resource('service-subcategories', ServiceSubCategoryController::class);

    // Services
    Route::get('services/sub-categories/{categoryId}', [ServiceController::class, 'getSubCategories'])->name('services.subCategories');
    Route::resource('services', ServiceController::class);

    // Projects
    Route::resource('projects', ProjectController::class);

    // Gallery
    Route::resource('gallery', GalleryController::class);

    // Videos
    Route::resource('videos', VideoController::class);

    // Blogs
    Route::resource('blogs', BlogController::class);

    // FAQs
    Route::resource('faqs', FaqController::class);
    Route::post('faqs/update-order', [FaqController::class, 'updateOrder'])->name('faqs.updateOrder');

    // Counters
    Route::resource('counters', CounterController::class);

    // Testimonials
    Route::resource('testimonials', TestimonialController::class);

    // Contacts
    Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // Settings
    Route::get('settings/general', [SettingController::class, 'general'])->name('settings.general');
    Route::post('settings/general', [SettingController::class, 'updateGeneral'])->name('settings.updateGeneral');
    Route::get('settings/logo', [SettingController::class, 'logo'])->name('settings.logo');
    Route::post('settings/logo', [SettingController::class, 'updateLogo'])->name('settings.updateLogo');
    Route::get('settings/footer', [SettingController::class, 'footer'])->name('settings.footer');
    Route::post('settings/footer', [SettingController::class, 'updateFooter'])->name('settings.updateFooter');
});
