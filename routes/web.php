<?php

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



// Route::get('/', 'MainController@welcome')->name('homepage');

// Route::get('testing', 'MainController@testing')->name('testingpage');

// Route::get('about', 'MainController@about')->name('aboutpage');

// Route::get('contact', 'MainController@contact')->name('contactpage');
Route::middleware('role:admin')->group(function () {
Route::resource('brand', 'BrandController');
Route::resource('category', 'CategoryController');
Route::resource('subcategory', 'SubcategoryController');
Route::resource('item', 'ItemController');
Route::post('filter', 'ItemController@filterCategory')->name('filterCategory');
});

Route::get('/', 'FrontendController@home')->name('mainpage');

Route::get('login_page', 'FrontendController@login')->name('login_page');

Route::get('signup_page', 'FrontendController@signup')->name('signup_page');


Route::get('itemdetail/{id}', 'FrontendController@itemdetail')->name('itemdetail');

Route::get('cart', 'FrontendController@cart')->name('cartpage');

Route::resource('order', 'OrderController');

Route::post('confirm/{id}', 'OrderController@confirm')->name('order.confirm');

Route::get('itemsbysubcategory/{id}', 'FrontendController@itemsbysubcategory')->name('itemsbysubcategory');

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('user', 'UserController');
