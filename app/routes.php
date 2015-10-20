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
Route::get('/', array(
    'as' => 'home',
    'uses' => 'PhoneController@getHome'
));

Route::get('/phone/add', array(
    'as' => 'addNum',
    'uses' => 'PhoneController@getPhoneForm'
));

Route::get('/phone/del', array(
    'as' => 'delNum',
    'uses' => 'PhoneController@getDelForm'
));

Route::get('/phone/number', array(
    'as' => 'phoneNumber',
    'uses' => 'PhoneController@getNumber'
));

Route::get('/phone/del/{phone}', array(
    'as' => 'delete',
    'uses' => 'PhoneController@getDelete'
));

Route::post('/phone/data', array(
    'as' => 'phoneData',
    'uses' => 'PhoneController@postData'
));

Route::post('/phone/phone', array(
    'as' => 'add',
    'uses' => 'PhoneController@postPhoneForm'
));