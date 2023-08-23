<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\FrontendLoginController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\SubscribersController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\Frontend\InvoiceController;

Route::get('/', [FrontendController::class, 'index'])->name('index');

// search music
Route::get('/search-music', [FrontendController::class, 'searchMusic'])->name('frontend.search.music');

Route::match(['get', 'post'], '/signup', [FrontendLoginController::class, 'register'])->name('register');

Route::match(['get', 'post'], '/login', [FrontendLoginController::class, 'login'])->name('frontend.login');

// forgot
Route::match(['get', 'post'], '/forgot', [FrontendLoginController::class, 'forgot'])->name('frontend.forgot');

// Authenticated routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [FrontendLoginController::class, 'logout'])->name('frontend.logout');
    Route::get('/account', [FrontendController::class, 'account'])->name('frontend.account');
    Route::get('/edit-account', [FrontendController::class, 'editAccount'])->name('frontend.edit.account');
    Route::post('/update-account', [FrontendController::class, 'updateAccount'])->name('frontend.update.account');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('frontend.checkout');
    // updae password
    Route::match(['get', 'post'], '/update-password', [FrontendLoginController::class, 'updatePassword'])->name('frontend.update.password');
});
Route::get('/invoice/{id}', [InvoiceController::class, 'invoice'])->name('frontend.invoice');
Route::get('/invoice/{licenseId}/download', [InvoiceController::class, 'downloadInvoice'])->name('invoices.download');
Route::get('/agreement/{id}', [InvoiceController::class, 'agreement'])->name('frontend.agreement');
Route::get('/agreement/{licenseId}/download', [InvoiceController::class, 'downloadAgreement'])->name('agreements.download');

// for subscribers
Route::post('/subscriber', [SubscribersController::class, 'store'])->name('subscriber.store');
// unsubscriber
Route::post('unsubscriber', [SubscribersController::class, 'unsubscriber'])->name('subscriber.destroy');

Route::get('/about', [FrontendController::class, 'about'])->name('frontend.about');
// music-search with optional search term
Route::get('/music-search', [FrontendController::class, 'musicSearch'])->name('frontend.music.search');

// Route::match(['get', 'post'], '/music-search/{search?}',[FrontendController::class,'musicSearch'])->name('frontend.music.search');
Route::get('/licensing', [FrontendController::class, 'licensing'])->name('frontend.licensing');
Route::get('/contact', [FrontendController::class, 'contact'])->name('frontend.contact');
Route::get('/terms', [FrontendController::class, 'terms'])->name('frontend.terms');
// contact.storeInformation
Route::post('/contact/store', [FrontendController::class, 'storeInformation'])->name('contact.storeInformation');

// cart
Route::get('/cart', [CartController::class, 'cart'])->name('frontend.cart');
Route::get('/add-to-cart', [CartController::class, 'addToCart'])->name('frontend.cart.add');
Route::post('/save-cart-values', [CartController::class, 'saveCartValues'])->name('frontend.cart.save.values');
Route::post('/save-company-information', [CartController::class, 'saveCompanyInfo'])->name('frontend.cart.save.company.info');
Route::get('/remove-cart-item/{id}', [CartController::class, 'removeCartItem'])->name('frontend.cart.remove.item');

// license-edit
Route::get('/license-edit', [CartController::class, 'licenseEdit'])->name('frontend.license.edit');
Route::post('/handle-change', [CartController::class, 'handleChange'])->name('frontend.handle.change');
Route::post('/update-license', [CartController::class, 'updateLicense'])->name('frontend.update.license');

Route::get('/license', [CartController::class, 'license'])->name('frontend.license');
Route::post('/apply-coupon', [CartController::class, 'applyCoupon'])->name('frontend.apply.coupon');
Route::post('/remove-coupon', [CartController::class, 'removeCoupon'])->name('frontend.remove.coupon');

// checkout
Route::post('/stripe-checkout', [StripeController::class, 'checkout'])->name('stripe-checkout');
Route::get('/stripe-success', [StripeController::class, 'success'])->name('stripe.success');
Route::get('/stripe-cancel', [StripeController::class, 'cancel'])->name('stripe.cancel');

Route::get('/test', [FrontendController::class, 'test'])->name('frontend.test');
