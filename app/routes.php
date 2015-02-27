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
    'as' => 'index',
    'uses' => 'WebsiteController@getIndex'
));

Route::get('/graph', array(
    'as' => 'graphs'
));

Route::get('/readings', array(
    'as' => 'readings'
));

Route::get('/set_threshold', array(
    'as' => 'form',
    'uses' => 'ReadingsController@getForm'
));

Route::post('/readings/data', array(
    'as' => 'variable',
    'uses' => 'ReadingsController@postVariable'
));

Route::get('/graph/{room}/{time_length}', array(
	'as' => 'graph',
	'uses' => 'ReadingsController@getGraph'
));

Route::get('/update_ip/{ip}/{mac}', array(  // if {mac} is not in table ip2name, add a new row with room name 新车间
                                            // if {mac} is already in table ip2name, then update the {IP}
                                            // This interface is for raspberry pi only
    'as' => 'updateIP',
    'uses' => 'AddressController@getUpdate'
));

Route::get('/threshold', array(             // display all entries in the table threshold
    'as' => 'getThreshold',
    'uses' => 'ThresholdController@getThreshold'
));

Route::get('/devices', array(               // display all entries in the table ip2name
    'as' => 'devices',
    'uses' => 'DeviceController@getDevices'
));

Route::get('/devices/delete/{mac}', array(               // display all entries in the table ip2name
    'as' => 'delete',
    'uses' => 'DeviceController@getDelete'
));

Route::Controller('readings', 'ReadingsController');    // present table and bar graph