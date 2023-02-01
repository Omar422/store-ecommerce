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

            // Categories Routes
            Route::group(['prefix'=>'categories'], function(){
                Route::get('/', 'CategoriesController@index')->name('admin.categories');
                Route::get('create', 'CategoriesController@create')->name('admin.categories.create');
                Route::post('store', 'CategoriesController@store')->name('admin.categories.store');
                Route::get('edit/{id}', 'CategoriesController@edit')->name('admin.categories.edit');
                Route::post('update/{id}', 'CategoriesController@update')->name('admin.categories.update');
                Route::get('delete/{id}', 'CategoriesController@destroy')->name('admin.categories.delete');
                Route::get('status/{id}', 'CategoriesController@changeStatus')->name('admin.categories.status');
            });

            // sub Categories Routes ==> Canceled
            // Route::group(['prefix'=>'sub_categories'], function(){
            //     Route::get('/', 'SubCategoriesController@index')->name('admin.subcategories');
            //     Route::get('create', 'SubCategoriesController@create')->name('admin.subcategories.create');
            //     Route::post('store', 'SubCategoriesController@store')->name('admin.subcategories.store');
            //     Route::get('edit/{id}', 'SubCategoriesController@edit')->name('admin.subcategories.edit');
            //     Route::post('update/{id}', 'SubCategoriesController@update')->name('admin.subcategories.update');
            //     Route::get('delete/{id}', 'SubCategoriesController@destroy')->name('admin.subcategories.delete');
            //     Route::get('status/{id}', 'SubCategoriesController@changeStatus')->name('admin.subcategories.status');
            // });

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

            // Products Routes
            Route::group(['prefix'=>'products'], function(){
                Route::get('/', 'ProductsController@index')->name('admin.products');
                Route::get('general-information', 'ProductsController@create')->name('admin.products.general.create');
                Route::post('store-general-information', 'ProductsController@store')->name('admin.products.general.store');
                Route::get('price/{id}', 'ProductsController@getPrice')->name('admin.products.price');
                Route::post('price', 'ProductsController@saveProductPrice')->name('admin.products.price.store');
                Route::get('stock/{id}', 'ProductsController@getStock')->name('admin.products.stock');
                Route::post('stock', 'ProductsController@saveProductStock')->name('admin.products.stock.store');
                Route::get('images/{id}', 'ProductsController@addimages')->name('admin.products.images');
                Route::post('images', 'ProductsController@uploadProductimages')->name('admin.products.images.upload');
                Route::post('images/save', 'ProductsController@saveProductimages')->name('admin.products.images.store');
                Route::get('images/delete/{id}', 'ProductsController@deleteimage')->name('admin.products.images.delete');
            });

            // Product Attributes Routes
            Route::group(['prefix'=>'attributes'], function(){
                Route::get('/', 'AttributesController@index')->name('admin.attributes');
                Route::get('create', 'AttributesController@create')->name('admin.attributes.create');
                Route::post('store', 'AttributesController@store')->name('admin.attributes.store');
                Route::get('edit/{id}', 'AttributesController@edit')->name('admin.attributes.edit');
                Route::post('update/{id}', 'AttributesController@update')->name('admin.attributes.update');
                Route::get('delete/{id}', 'AttributesController@destroy')->name('admin.attributes.delete');
            });

            // Product Attribute Options Routes

            Route::group(['prefix' => 'attributes-options'], function(){
                Route::get('/', 'AttributeOptionsController@index')->name('admin.attribute.options');
                Route::get('create', 'AttributeOptionsController@create')->name('admin.attribute.options.create');
                Route::post('store', 'AttributeOptionsController@store')->name('admin.attribute.options.store');
                Route::get('edit/{id}', 'AttributeOptionsController@edit')->name('admin.attribute.options.edit');
                Route::post('update/{id}', 'AttributeOptionsController@update')->name('admin.attribute.options.update');
                Route::get('delete/{id}', 'AttributeOptionsController@destroy')->name('admin.attribute.options.delete');
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
