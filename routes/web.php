<?php

use Illuminate\Support\Facades\Auth;
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

// -- cek debug di sentry --
// Route::get('/debug-sentry', function () {
//     throw new Exception('My first Sentry error!');
// });

Route::get('/', 'HomeController@index')->name('home'); // mengarah ke halaman index
Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/categories/{id}', 'CategoryController@details')->name('categories-detail');
Route::get('/details/{id}', 'DetailController@index')->name('detail');
Route::post('/details/{id}', 'DetailController@add')->name('detail-add');
// checkout buat midtrans
Route::get('/checkout/callback', 'CheckoutController@callback')->name('midtrans-callback');
Route::get('/success', 'CartController@success')->name('success');


// -- register --
Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');


// -- middleware umum --
Route::group(['middleware' => ['auth']], function(){
  Route::get('/cart', 'CartController@index')->name('cart');
  Route::delete('/cart/{id}', 'CartController@delete')->name('cart-delete');

  Route::post('/checkout', 'CheckoutController@process')->name('checkout');

  // -- dashboard user --
  Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
  // product
  Route::get('/dashboard/products', 'DashboardProductController@index')->name('dashboard-product');
  Route::get('/dashboard/products/create', 'DashboardProductController@create')->name('dashboard-product-create');
  Route::post('/dashboard/products', 'DashboardProductController@store')->name('dashboard-product-store');
  Route::get('/dashboard/products/{id}', 'DashboardProductController@details')->name('dashboard-product-details');
  Route::post('/dashboard/products/{id}', 'DashboardProductController@update')->name('dashboard-product-update');
  // product gallery
  Route::post('/dashboard/products/gallery/upload', 'DashboardProductController@uploadGallery')->name('dashboard-product-gallery-upload');
  Route::get('/dashboard/products/gallery/delete/{id}', 'DashboardProductController@deleteGallery')->name('dashboard-product-gallery-delete');
  // transaction
  Route::get('/dashboard/transactions', 'DashboardTransactionController@index')->name('dashboard-transaction');
  Route::get('/dashboard/transactions/{id}', 'DashboardTransactionController@details')->name('dashboard-transaction-details');
  Route::post('/dashboard/transactions/{id}', 'DashboardTransactionController@update')->name('dashboard-transaction-update');
  // setting user dan account
  Route::get('/dashboard/settings', 'DashboardSettingController@store')->name('dashboard-settings-store');
  Route::get('/dashboard/account', 'DashboardSettingController@account')->name('dashboard-settings-account');
  Route::post('/dashboard/account/{redirect}', 'DashboardSettingController@update')->name('dashboard-settings-redirect');
});


// -- dashboard admin --
// middleware(auth, admin)
Route::prefix('admin')->namespace('Admin')->group(function(){
  Route::get('/', 'DashboardController@index')->name('admin-dashboard');
  Route::resource('category', 'CategoryController');
  Route::resource('user', 'UserController');
  Route::resource('product', 'ProductController');
  Route::resource('product-gallery', 'ProductGalleryController');
});

Auth::routes();

