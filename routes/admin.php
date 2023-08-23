<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TermController;
use App\Http\Controllers\Admin\TerritoryController;
use App\Http\Controllers\Admin\VersionController;
use App\Http\Controllers\Admin\TempoController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\LicenseController;
use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\MusicTitleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PagesAboutController;
use App\Http\Controllers\Admin\PagesMusicSearchController;
use App\Http\Controllers\Admin\PagesLicensingController;
use App\Http\Controllers\Admin\PagesContactController;
use App\Http\Controllers\Admin\PagesTermsController;
use App\Http\Controllers\Admin\PagesHomeController;
use App\Http\Controllers\Admin\NewsLetterSubscriberController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//for login
Route::match(['get', 'post'], '/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');

// for grouping
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['admin']], function () {
    // for logout
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    //for dashboard
    Route::get('dashboard', [LicenseController::class, 'dashboard'])->name('dashboard');
    //for term
    Route::get('/term', [TermController::class, 'index'])->name('term');
    Route::get('/add/term', [TermController::class, 'create'])->name('term.create');
    Route::post('/add/term', [TermController::class, 'store'])->name('term.store');
    Route::get('/term/edit/{id}', [TermController::class, 'edit'])->name('term.edit');
    Route::post('/term/update/{id}', [TermController::class, 'update'])->name('term.update');
    Route::get('/term/delete/{id}', [TermController::class, 'delete'])->name('term.delete');
    Route::get('/term/search', [TermController::class, 'search'])->name('term.search');
    //for territory
    Route::get('/territory', [TerritoryController::class, 'index'])->name('territory');
    Route::get('/add/territory', [TerritoryController::class, 'create'])->name('territory.create');
    Route::post('/add/territory', [TerritoryController::class, 'store'])->name('territory.store');
    Route::get('/territory/edit/{id}', [TerritoryController::class, 'edit'])->name('territory.edit');
    Route::post('/territory/update/{id}', [TerritoryController::class, 'update'])->name('territory.update');
    Route::get('/territory/delete/{id}', [TerritoryController::class, 'delete'])->name('territory.delete');
    Route::get('/territory/search', [TerritoryController::class, 'search'])->name('territory.search');

    //for version
    Route::get('/version', [VersionController::class, 'index'])->name('version');
    Route::get('/add/version', [VersionController::class, 'create'])->name('version.create');
    Route::post('/add/version', [VersionController::class, 'store'])->name('version.store');
    Route::get('/version/edit/{id}', [VersionController::class, 'edit'])->name('version.edit');
    Route::post('/version/update/{id}', [VersionController::class, 'update'])->name('version.update');
    Route::get('/version/delete/{id}', [VersionController::class, 'delete'])->name('version.delete');
    Route::get('/version/search', [VersionController::class, 'search'])->name('version.search');

    //for tempo

    Route::get('/tempo', [TempoController::class, 'index'])->name('tempo');
    Route::get('/add/tempo', [TempoController::class, 'create'])->name('tempo.create');
    Route::post('/add/tempo', [TempoController::class, 'store'])->name('tempo.store');
    Route::get('/tempo/edit/{id}', [TempoController::class, 'edit'])->name('tempo.edit');
    Route::post('/tempo/update/{id}', [TempoController::class, 'update'])->name('tempo.update');
    Route::get('/tempo/delete/{id}', [TempoController::class, 'delete'])->name('tempo.delete');
    Route::get('/tempo/search', [TempoController::class, 'search'])->name('tempo.search');

    //for genre
    Route::get('/genre', [GenreController::class, 'index'])->name('genre');
    Route::get('/add/genre', [GenreController::class, 'create'])->name('genre.create');
    Route::post('/add/genre', [GenreController::class, 'store'])->name('genre.store');
    Route::get('/genre/edit/{id}', [GenreController::class, 'edit'])->name('genre.edit');
    Route::post('/genre/update/{id}', [GenreController::class, 'update'])->name('genre.update');
    Route::get('/genre/delete/{id}', [GenreController::class, 'delete'])->name('genre.delete');
    Route::get('/genre/search', [GenreController::class, 'search'])->name('genre.search');

    //for license
    Route::get('/license', [LicenseController::class, 'index'])->name('license');
    Route::get('/add/license', [LicenseController::class, 'create'])->name('license.create');
    Route::post('/add/license', [LicenseController::class, 'store'])->name('license.store');
    Route::get('/license/edit/{id}', [LicenseController::class, 'edit'])->name('license.edit');
    Route::post('/license/update/{id}', [LicenseController::class, 'update'])->name('license.update');
    Route::get('/license/delete/{id}', [LicenseController::class, 'delete'])->name('license.delete');
    Route::get('/license/search', [LicenseController::class, 'search'])->name('license.search');

    Route::get('/license/exportCsv', [LicenseController::class, 'exportCsv'])->name('license.exportCsv');
    Route::get('/license/exportExcel', [LicenseController::class, 'exportExcel'])->name('license.exportExcel');

    //for artist
    Route::get('/artist', [ArtistController::class, 'index'])->name('artist');
    Route::get('/add/artist', [ArtistController::class, 'create'])->name('artist.create');
    Route::post('/add/artist', [ArtistController::class, 'store'])->name('artist.store');
    Route::get('/artist/edit/{id}', [ArtistController::class, 'edit'])->name('artist.edit');
    Route::post('/artist/update/{id}', [ArtistController::class, 'update'])->name('artist.update');
    Route::get('/artist/delete/{id}', [ArtistController::class, 'delete'])->name('artist.delete');
    Route::get('/artist/search', [ArtistController::class, 'search'])->name('artist.search');
    //for music titles
    Route::get('/musictitle', [MusicTitleController::class, 'index'])->name('musictitles');
    Route::get('/add/musictitle', [MusicTitleController::class, 'create'])->name('musictitles.create');
    Route::post('/add/musictitle', [MusicTitleController::class, 'store'])->name('musictitles.store');
    Route::get('/musictitle/edit/{id}', [MusicTitleController::class, 'edit'])->name('musictitles.edit');
    Route::post('/musictitle/update/{id}', [MusicTitleController::class, 'update'])->name('musictitles.update');
    Route::get('/musictitle/delete/{id}', [MusicTitleController::class, 'delete'])->name('musictitles.delete');
    Route::get('/musictitle/search', [MusicTitleController::class, 'search'])->name('musictitles.search');

    // for slider
    Route::get('/slider', [SliderController::class, 'index'])->name('slider');
    Route::get('/add/slider', [SliderController::class, 'create'])->name('slider.create');
    Route::post('/add/slider', [SliderController::class, 'store'])->name('slider.store');
    Route::get('/slider/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::post('/slider/update/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::get('/slider/delete/{id}', [SliderController::class, 'delete'])->name('slider.delete');
    Route::get('/slider/search', [SliderController::class, 'search'])->name('slider.search');

    // for states
    Route::get('/state', [StateController::class, 'index'])->name('state');
    Route::get('/add/state', [StateController::class, 'create'])->name('state.create');
    Route::post('/add/state', [StateController::class, 'store'])->name('state.store');
    Route::get('/state/edit/{id}', [StateController::class, 'edit'])->name('state.edit');
    Route::post('/state/update/{id}', [StateController::class, 'update'])->name('state.update');
    Route::get('/state/delete/{id}', [StateController::class, 'delete'])->name('state.delete');
    Route::get('/state/search', [StateController::class, 'search'])->name('state.search');

    // for country
    Route::get('/country', [CountryController::class, 'index'])->name('country');
    Route::get('/add/country', [CountryController::class, 'create'])->name('country.create');
    Route::post('/add/country', [CountryController::class, 'store'])->name('country.store');
    Route::get('/country/edit/{id}', [CountryController::class, 'edit'])->name('country.edit');
    Route::post('/country/update/{id}', [CountryController::class, 'update'])->name('country.update');
    Route::get('/country/delete/{id}', [CountryController::class, 'delete'])->name('country.delete');
    Route::get('/country/search', [CountryController::class, 'search'])->name('country.search');

    //for newslettersubscriber
    Route::get('/newsletter/subscribers', [NewsLetterSubscriberController::class, 'index'])->name('subscribe');
    Route::get('/newsletter/add/subscribe', [NewsLetterSubscriberController::class, 'create'])->name('subscribe.create');
    Route::post('newsletter/add/subscribe', [NewsLetterSubscriberController::class, 'store'])->name('subscribe.store');
    Route::get('/newsletter/subscribe/edit/{id}', [NewsLetterSubscriberController::class, 'edit'])->name('subscribe.edit');
    Route::post('newsletter/subscribe/update/{id}', [NewsLetterSubscriberController::class, 'update'])->name('subscribe.update');
    Route::get('newsletter/unsubscribe/{id}', [NewsLetterSubscriberController::class, 'delete'])->name('subscribe.delete');
    Route::get('newsletter/subscribe/search', [NewsLetterSubscriberController::class, 'search'])->name('subscribe.search');

    // for settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [SettingsController::class, 'store'])->name('settings.store');
    Route::post('/settings/social-media', [SettingsController::class, 'updateSocialMedia'])->name('settings.social-media.update');
    Route::post('/settings/mailing-address', [SettingsController::class, 'updateMailingAddress'])->name('settings.mailing-address.update');

    // for profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // for faqs
    Route::get('/faqs', [FaqsController::class, 'index'])->name('faqs');
    Route::get('/add/faqs', [FaqsController::class, 'create'])->name('faqs.create');
    Route::post('/add/faqs', [FaqsController::class, 'store'])->name('faqs.store');
    Route::get('/faqs/edit/{id}', [FaqsController::class, 'edit'])->name('faqs.edit');
    Route::post('/faqs/update/{id}', [FaqsController::class, 'update'])->name('faqs.update');
    Route::get('/faqs/delete/{id}', [FaqsController::class, 'delete'])->name('faqs.delete');
    Route::get('/faqs/search', [FaqsController::class, 'search'])->name('faqs.search');
    Route::get('/faqs/detail/{id}', [FaqsController::class, 'details'])->name('faqs.details');

    //for pages 
    Route::group(['prefix' => 'pages', 'namespace' => 'pages'], function () {

        // for home
        Route::get('/home', [PagesHomeController::class, 'create'])->name('home.create');
        Route::post('/home', [PagesHomeController::class, 'store'])->name('home.store');

        //for about content
        Route::get('/about', [PagesAboutController::class, 'create'])->name('about.create');
        Route::post('/about', [PagesAboutController::class, 'store'])->name('about.store');

        //music search
        Route::get('/musicsearch', [PagesMusicSearchController::class, 'create'])->name('musicsearch.create');
        Route::post('/musicsearch', [PagesMusicSearchController::class, 'store'])->name('musicsearch.store');

        //for licensing
        Route::get('/licensing', [PagesLicensingController::class, 'create'])->name('licensing.create');
        Route::post('/licensing', [PagesLicensingController::class, 'store'])->name('licensing.store');

        // for promotion
        Route::get('/promotion', [PromotionController::class, 'index'])->name('promotion');
        Route::post('/promotion/send-email', [PromotionController::class, 'sendPromotionEmail'])->name('send-promotion-email');

        //for contact
        Route::get('/contact', [PagesContactController::class, 'create'])->name('contact.create');
        Route::post('/contact', [PagesContactController::class, 'store'])->name('contact.store');

        //for terms
        Route::get('/terms', [PagesTermsController::class, 'create'])->name('terms.create');
        Route::post('/terms', [PagesTermsController::class, 'store'])->name('terms.store');
    });

    // contact
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::get('/contact/delete/{id}', [ContactController::class, 'delete'])->name('contact.delete');
    Route::get('/contact/search', [ContactController::class, 'search'])->name('contact.search');

    // for users
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/users/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

    // coupon routes
    Route::get('/coupon', [CouponController::class, 'index'])->name('coupon');
    Route::get('/add/coupon', [CouponController::class, 'create'])->name('coupon.create');
    Route::post('/store/coupon', [CouponController::class, 'store'])->name('coupon.store');
    Route::get('/coupon/edit/{id}', [CouponController::class, 'edit'])->name('coupon.edit');
    Route::post('/coupon/update/{id}', [CouponController::class, 'update'])->name('coupon.update');
    Route::get('/coupon/delete/{id}', [CouponController::class, 'delete'])->name('coupon.delete');

    // puchase route
    Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase');
    Route::get('/purchase/delete/{id}', [PurchaseController::class, 'delete'])->name('purchase.delete');
    // reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
});
