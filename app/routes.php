<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::post('/phone/data', array(
    'as' => 'phoneData',
    'uses' => 'PhoneController@postData'
));

Route::get('/phone/number', array(
    'as' => 'phoneNumber',
    'uses' => 'PhoneController@getNumber'
));