<?php

// dd(resolve('App\Billing\Stripe'));


Route::get('/', 'PostController@index')->name('home');
Route::resource('/posts', 'PostController');

Route::post('/posts/{post}/comments', 'CommentController@store');

// custom
Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionController@create');
Route::post('/login', 'SessionController@store');
Route::get('/logout', 'SessionController@destroy');
