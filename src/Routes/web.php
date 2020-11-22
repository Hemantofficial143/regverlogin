<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Jangid\Regverlogin\Http\Controllers','middleware' => ['web']],function(){
    Route::get('/register','RegisterController@index');
    Route::post('/register','RegisterController@store')->name('register.post');
    Route::get('/verify/{token}','RegisterController@verify');
    Route::get('/forgot','ForgotPasswordController@index')->name('forgot');
    Route::post('/forgot','ForgotPasswordController@attemptForgot')->name('forgot.post');
    Route::get('/reset-password/{token}','ForgotPasswordController@resetPasswordIndex')->name('reset-password');
    Route::post('/reset-password/{token}','ForgotPasswordController@resetPassword')->name('reset-password.post');
    Route::get('/login','LoginController@index')->name('login');
    Route::post('/login','LoginController@attempt')->name('login.post');
    Route::group(['middleware' => 'auth'],function(){
        Route::get('/dashboard','UserController@index');    
        Route::get('/logout','LoginController@logout');    
    });
});
