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

Route::get('/',function () {
    return view('imageGame');
});
Route::get('/category',function () {
    return view('category');
});
Route::post('nextcat','ImageGalleryController@nextCat');
Route::get('getimages','ImageGalleryController@getImages');


Route::get('admin', 'ImageGalleryController@index');
Route::post('admin', 'ImageGalleryController@upload');
Route::get('admin/{id}', 'ImageGalleryController@destroy');

Route::post('category', 'ImageGalleryController@addCategory');
Route::get('getCategories', 'ImageGalleryController@getCategories');

