<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// Authentication Routes...
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');

// Registration Routes...
Route::get('register', 'Auth\AuthController@showRegistrationForm');
Route::post('register', 'Auth\AuthController@register');

// Password Reset Routes...
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');


Route::get('/', 'IndexController@index');

//Dashboard Route
Route::get('home', function() {
    return redirect('dashboard');
});
Route::get('dashboard', 'DashboardController@index');

//Director Select Route
Route::post('change/director', 'DashboardController@changeDirector');

//Directors Routes
Route::get('directors', 'DirectorsController@index');
Route::get('directors/add', 'DirectorsController@add');
Route::get('directors/edit/{id}', 'DirectorsController@edit');
Route::post('directors/create', 'DirectorsController@create');
Route::post('directors/save/{id}', 'DirectorsController@save');
Route::get('directors/delete/{id}', 'DirectorsController@delete');

//Clients Routes
Route::get('clients', 'ClientsController@index');

//Schedules Routes
Route::get('schedules', 'SchedulesController@index');
Route::get('schedules/add', 'SchedulesController@add');
Route::get('schedules/edit/{id}', 'SchedulesController@edit');
Route::post('schedules/create', 'SchedulesController@create');
Route::post('schedules/save/{id}', 'SchedulesController@save');
Route::get('schedules/delete/{id}', 'SchedulesController@delete');

//Templates Routes
Route::get('templates', 'TemplatesController@index');
Route::get('templates/add', 'TemplatesController@add');
Route::get('templates/edit/{id}', 'TemplatesController@edit');
Route::post('templates/create', 'TemplatesController@create');
Route::post('templates/save/{id}', 'TemplatesController@save');
Route::get('templates/delete/{id}', 'TemplatesController@delete');

//Contacts Routes
Route::get('contacts', 'ContactsController@index');
Route::get('contacts/add', 'ContactsController@add');
Route::get('contacts/edit/{id}', 'ContactsController@edit');
Route::post('contacts/create', 'ContactsController@create');
Route::post('contacts/save/{id}', 'ContactsController@save');
Route::get('contacts/delete/{id}', 'ContactsController@delete');

//Jobs Routes
Route::get('jobs/{id}', 'JobsController@index');
Route::get('jobs/{id}/add', 'JobsController@add');
Route::get('jobs/{director}/edit/{id}', 'JobsController@edit');
Route::get('jobs/{director}/delete/{id}', 'JobsController@delete');
Route::post('jobs/{id}/create', 'JobsController@create');
Route::post('jobs/{director}/save/{id}', 'JobsController@save');

//Settings Routes

    //Users Routes
    Route::get('settings/users', 'UsersController@index');
    Route::get('settings/users/add', 'UsersController@add');
    Route::post('settings/users/create', 'UsersController@create');
    Route::get('settings/users/edit/{id}', 'UsersController@edit');
    Route::post('settings/users/save/{id}', 'UsersController@save');
    Route::get('settings/users/delete/{id}', 'UsersController@delete');
