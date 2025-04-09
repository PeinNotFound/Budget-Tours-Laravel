<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Packages\PostController;
use App\Http\Controllers\DestinationsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;

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

// Public routes
Route::get('/', 'WelcomeController@index');
Route::get('/search', 'WelcomeController@search')->name('search');
Route::get('/packages/destinations/{destination}', [DestinationsController::class, 'show'])->name('desti.show');
Route::get('/destinations/{id}/modal', [DestinationsController::class, 'modal'])->name('destinations.modal');
Route::get('/share', 'WelcomeController@share')->name('share');
Route::get('/share/search', 'WelcomeController@shareSearch')->name('share.search');

// Auth routes
Auth::routes();

// Routes for authenticated users (both normal users and admins)
Route::middleware(['auth'])->group(function () {
    // Normal user routes
    Route::get('/home', function() {
        if (auth()->user()->is_admin) {
            return redirect()->route('dashboard');
        }
        return redirect('/');
    })->name('home');

    // Profile routes for normal users
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
});

// Admin only routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UsersController::class, 'update'])->name('users.update');
    Route::post('/users/{user}/make-admin', [UsersController::class, 'makeAdmin'])->name('users.make-admin');
    
    // Admin-only resource routes
    Route::resource('categories', "CategoriesController");
    Route::resource('destinations', "DestinationsController");
    Route::resource('tags', "TagsController");
    Route::resource('blog', "BlogController");
    
    Route::get('trashed-destinations', 'DestinationsController@trashed')->name('trashed-destinations.index');
    Route::put('restore-destinations/{destinations}', 'DestinationsController@restore')->name('restore-destinations');
});

Route::group(['middleware' => ['isVerified']], function () {
    Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');
    Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');
});

Route::get('/about', [
    'uses' => 'WelcomeController@about',
    'as' => 'about'
]);

Route::get('/packages', [
    'uses' => 'WelcomeController@packages',
    'as' => 'packages'
]);

Route::get('/packages/category/{category}', [
    'uses' => 'WelcomeController@categoryDestinations',
    'as' => 'packages.category'
]);

Route::get('/news', [
    'uses' => 'WelcomeController@blog',
    'as' => 'blog'
]);

Route::get('/news/{id}', [
    'uses' => 'WelcomeController@blogShow',
    'as' => 'blog.show'
]);

Route::get('/contact', [
    'uses' => 'WelcomeController@contact',
    'as' => 'contact'
]);

Route::get('/Bali', [
    'uses' => 'WelcomeController@Bali',
    'as' => 'Bali'
]);

Route::get('/cart', [
    'uses' => 'WelcomeController@cart',
    'as' => 'cart'
]);

Route::get('/checkout', [
    'uses' => 'WelcomeController@checkout',
    'as' => 'checkout'
]);

Route::get('/Checkout', [
    'uses' => 'CheckoutController@checkout',
    'as' => 'checkout.store'
]);


// Post form data
Route::post('/contact', [
    'uses' => 'ContactUsController@ContactUs',
    'as' => 'contact.store'
]);

Route::get('/stripe', [
    'uses' => 'WelcomeController@stripe',
    'as' => 'stripe'
]);

Route::get('/cart/{id}/remove', 'CartController@removeItem')->name('cart.remove');

Route::get('/send-email', 'MailController@sendEmail');
