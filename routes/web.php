<?php

use App\Http\Controllers\adsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\profileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

include('frontend-routes/frontend-web.php');

/* auth routes */
Auth::routes();
Route::prefix('admin')->group(function () {

    /* dashboard routes */
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    /* ads route */
    Route::controller(adsController::class)
        ->as('ads.')
        ->group(function () {
            Route::get('/ads-list', 'adsList')->name('ads-list');
            Route::post('/save-ads', 'saveAds')->name('save-ads');
            Route::get('/get-ads', 'getAds')->name('get-ads');
            Route::post('/delete-ads', 'deleteAds')->name('delete-ads');
            Route::post('/get-search-results', 'getSearchResult');
            Route::post('/update-product-category', 'updateProductCategory');
            Route::post('/update-product-sub-category', 'updateProductSubCategory');
            Route::post('/update-city', 'updateCity');
            Route::post('/update-ads-category', 'updateAdsCategory');
            Route::post('/delete-category', 'deleteProductCategory');
            Route::post('/delete-sub-category', 'deleteProductSubCategory');
            Route::post('/delete-city', 'deleteCity');
            Route::post('/delete-ads-category', 'deleteAdsCategory');
            Route::get('/view-ads/{recordid}', 'viewAds')->name('view-ads');
            Route::post('/get-ads-details', 'getAdsDetails');
            Route::post('/update-ads', 'updateAds');
        });

    /* profile routes */
    Route::controller(profileController::class)
        ->prefix('profile')
        ->as('profile.')
        ->group(function () {
            Route::get('/', 'index')->name('profile');
            Route::post('/save-profile', 'saveProfile');
            Route::post('/deactivate-profile', 'deactivateProfile');
            Route::post('/save-social-links', 'saveSocialLinks');
        });
});
