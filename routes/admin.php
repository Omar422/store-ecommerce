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

            // Brands Routes
            Route::group(['prefix'=>'brands'], function(){
                Route::get('/', 'BrandsController@index')->name('admin.brands');
                Route::get('create', 'BrandsController@create')->name('admin.brands.create');
                Route::post('store', 'BrandsController@store')->name('admin.brands.store');
                Route::get('edit/{id}', 'BrandsController@edit')->name('admin.brands.edit');
                Route::post('update/{id}', 'BrandsController@update')->name('admin.brands.update');
                Route::get('delete/{id}', 'BrandsController@destroy')->name('admin.brands.delete');
                Route::get('status/{id}', 'BrandsController@changeStatus')->name('admin.brands.status');
            });

            // Tags Routes
            Route::group(['prefix'=>'tags'], function(){
                Route::get('/', 'TagsController@index')->name('admin.tags');
                Route::get('create', 'TagsController@create')->name('admin.tags.create');
                Route::post('store', 'TagsController@store')->name('admin.tags.store');
                Route::get('edit/{id}', 'TagsController@edit')->name('admin.tags.edit');
                Route::post('update/{id}', 'TagsController@update')->name('admin.tags.update');
                Route::get('delete/{id}', 'TagsController@destroy')->name('admin.tags.delete');
                Route::get('status/{id}', 'TagsController@changeStatus')->name('admin.tags.status');
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
