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
Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/diseases/{id}', 'HomeController@diseases')->name('diseases');
Route::get('/konsultasi', 'HomeController@konsultasi')->name('konsultasi');
Route::post('/analisa', 'HomeController@konsultasiProcess')->name('konsultasi.process');

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => ['auth']], function () {
    Route::get('/', 'Dashboards\DashboardController@index')->name('index');

    Route::resource('diseases', 'Dashboards\DiseasesController');
    Route::resource('symptoms', 'Dashboards\SymptomsController');

    /**
     * Profile & User Route
     */
    Route::get('profile', 'Dashboards\UsersController@profile')->name('profile');
    Route::patch('profile/{user}', 'Dashboards\UsersController@profileUpdate')->name('profile.update');
    Route::resource('users', 'Dashboards\UsersController');

    /**
     * Roles & Permissions Administrator Route
     */
    /*Route::resource('roles', 'Dashboards\RolesController');
    Route::patch('permissions/sort-module', 'Dashboards\PermissionsController@sortModule')->name('permissions.sort-module');
    Route::resource('permissions', 'Dashboards\PermissionsController', ['except' => [
        'create', 'show', 'edit'
    ]]);*/
});
