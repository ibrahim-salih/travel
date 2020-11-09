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
    'namespace' => 'Dashboard',
    'middleware' => 'guest:admin',
    'prefix' => 'admin'
], function () {
    
    Route::get('login', 'LoginController@login')->name('admin.login');
    Route::post('login', 'LoginController@postLogin')->name('admin.post.login');
});
//*******End Login**********///////////

Route::group([
    'namespace' => 'Dashboard',
    'middleware' => 'auth:admin',
    'prefix' => 'admin'
], function () {
    
    Route::get('/', 'DashboardController@index')->name('admin.dashboard'); // the first page admin visits if authenticated
    //Route::get('login', 'LoginController@login')->name('admin');
    //Route::get('login', 'LoginController@login')->name('admin.login');
    Route::get('logout', 'LoginController@logout')->name('admin.logout');
    
    ############## Begin Languages Routes ###############
    Route::group([
        'prefix' => 'languages'
    ], function () {
        Route::get('/', 'LanguagesController@index')->name('admin.languages');
        Route::get('/create', 'LanguagesController@create')->name('admin.languages.create');
        Route::post('/store', 'LanguagesController@store')->name('admin.languages.store');
        Route::get('/edit/{id}', 'LanguagesController@edit')->name('admin.languages.edit');
        Route::post('/update/{id}', 'LanguagesController@update')->name('admin.languages.update');
        Route::get('/delete/{id}', 'LanguagesController@destroy')->name('admin.languages.delete');
    });
    // ############## End Languages Routes ###############
    ############## Begin Users Routes ###############
    Route::group([
        'prefix' => 'users'
    ], function () {
        Route::get('/', 'AdminController@index')->name('admin.users');
        Route::get('/create', 'AdminController@create')->name('admin.users.create');
        Route::post('/store', 'AdminController@store')->name('admin.users.store');
        Route::get('/edit/{id}', 'AdminController@edit')->name('admin.users.edit');
        Route::post('/update/{id}', 'AdminController@update')->name('admin.users.update');
        Route::get('/delete/{id}', 'AdminController@destroy')->name('admin.users.delete');
        
        Route::get('/editpassword/{id}', 'AdminController@passwordedit')->name('admin.userspassword.edit');
        Route::put('updatepassword', 'AdminController@updatepassword')->name('admin.userspassword.update');
        Route::get('deleteimage/{id}', 'AdminController@delete_image')->name('admin.userdelete.image');
    });
    // ############## End Users Routes ###############
    // ############## Begin Main Categories Routes ###############
    Route::group([
        'prefix' => 'main_categories'
    ], function () {
        Route::get('/', 'MainCategoryController@index')->name('admin.maincategories');
        Route::get('/create', 'MainCategoryController@create')->name('admin.maincategories.create');
        Route::post('/store', 'MainCategoryController@store')->name('admin.maincategories.store');
        Route::get('/edit/{id}', 'MainCategoryController@edit')->name('admin.maincategories.edit');
        Route::post('/update/{id}', 'MainCategoryController@update')->name('admin.maincategories.update');
        Route::get('/delete/{id}', 'MainCategoryController@destroy')->name('admin.maincategories.delete');
        Route::get('changeStatus/{id}', 'MainCategoryController@changeStatus')->name('admin.maincategories.status');
    });
    // ######################## End Main Categoris Routes ########################
    
});