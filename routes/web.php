<?php

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

Route::group(['namespace' => 'App\Http\Controllers'], function() {
    Route::get('/', 'WelcomeController@show');
    Route::get('/product/{product}', 'ProductController@show');
    Route::get('/product/{product}/addToBasket', 'ProductController@perform');
    Route::post('/review/post', 'ReviewController@store');
    Route::get('/search', 'SearchController@show');
    Route::get('/basket', 'BasketController@show');
    Route::post('/basket', 'BasketController@perform');


    Route::get('/admin', 'AdminProductController@show');
    Route::get('/admin/product/create', 'AdminCreateProductController@show');
    Route::post('/admin/product/create', 'AdminCreateProductController@store');
    Route::get('/admin/category/create', 'AdminCreateCategoryController@show');
    Route::post('/admin/category/create', 'AdminCreateCategoryController@store');
});
