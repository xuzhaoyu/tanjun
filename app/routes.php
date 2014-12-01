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

Route::get('/readings', array(
	'as' => 'home'
));

Route::get('/readings/threshold', array(
    'as' => 'form',
    'uses' => 'ReadingsController@getForm'
));

Route::post('/readings/data', array(
    'as' => 'variable',
    'uses' => 'ReadingsController@postVariable'
));

Route::get('/readings/{room}', array(
	'as' => 'graph',
	'uses' => 'ReadingsController@getGraph'
));

Route::get('/mac/{IP}/{mac}', array(
    'as' => 'updateMac',
    'uses' => 'AddressController@getUpdate'
));

Route::Controller('readings', 'ReadingsController');
