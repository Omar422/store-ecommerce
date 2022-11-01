<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]

], function() {

        Route::group([
            'namespace'=>'Dashboard',
            'middleware'=>'auth:admin',
            'prefix'=>'admin'
        ], function() {

            // main routes
            Route::get('/', 'dashboardController@index')->name('admin.dashboard');
            Route::get('logout', 'LoginController@logout')->name('admin.logout');

            // Settings Routes
            Route::group(['prefix'=>'settings'], function(){
                Route::get('shipping-methods/{type}', 'SettingsController@editShippingMethods')->name('edit.shipping.methods');
                Route::put('shipping-methods/{id}', 'SettingsController@updateShippingMethods')->name('update.shipping.methods');
            });

            // Profile Routes
            Route::group(['prefix'=>'profile'], function(){
                Route::get('edit', 'ProfileController@editProfile')->name('edit.profile');
                Route::put('update', 'ProfileController@updateProfile')->name('update.profile');
            });

            // main Categories Routes
            Route::group(['prefix'=>'main_categories'], function(){
                Route::get('/', 'MainCategoriesController@index')->name('admin.maincategories');
                Route::get('create', 'MainCategoriesController@create')->name('admin.maincategories.create');
                Route::post('store', 'MainCategoriesController@store')->name('admin.maincategories.store');
                Route::get('edit/{id}', 'MainCategoriesController@edit')->name('admin.maincategories.edit');
                Route::post('update/{id}', 'MainCategoriesController@update')->name('admin.maincategories.update');
                Route::get('delete/{id}', 'MainCategoriesController@destroy')->name('admin.maincategories.delete');
                Route::get('status/{id}', 'MainCategoriesController@changeStatus')->name('admin.maincategories.status');
            });

            // sub Categories Routes
            Route::group(['prefix'=>'sub_categories'], function(){
                Route::get('/', 'SubCategoriesController@index')->name('admin.subcategories');
                Route::get('create', 'SubCategoriesController@create')->name('admin.subcategories.create');
                Route::post('store', 'SubCategoriesController@store')->name('admin.subcategories.store');
                Route::get('edit/{id}', 'SubCategoriesController@edit')->name('admin.subcategories.edit');
                Route::post('update/{id}', 'SubCategoriesController@update')->name('admin.subcategories.update');
                Route::get('delete/{id}', 'SubCategoriesController@destroy')->name('admin.subcategories.delete');
                Route::get('status/{id}', 'SubCategoriesController@changeStatus')->name('admin.subcategories.status');
            });

        });

        Route::group([
            'namespace'=>'Dashboard',
            'middleware'=>'guest:admin',
            'prefix'=>'admin'
        ], function() {
            Route::get('login','LoginController@login')->name('admin.login');
            Route::post('login','LoginController@postLogin')->name('admin.post.login');
        });

});
