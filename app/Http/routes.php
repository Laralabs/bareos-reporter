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

    //Clients Routes
    Route::get('clients', 'ClientsController@index');
 