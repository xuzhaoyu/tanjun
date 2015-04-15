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
    'uses' => 'WebsiteController@getIndex'
));

Route::group(array('before' => 'guest'), function(){

   Route::group(array('before' => 'csrf'), function(){

       Route::post('/account/login', array(
           'as' => 'account-login-post',
           'uses' => 'AccountController@postLogin'
       ));

       Route::post('/account/create', array(
           'as' => 'account-create-post',
           'uses' => 'AccountController@postCreate'
       ));

   });

    Route::get('/account/login', array(
        'as' => 'account-login',
        'uses' => 'AccountController@getLogin'
    ));

    Route::get('/account/create', array(
        'as' => 'account-create',
        'uses' => 'AccountController@getCreate'
    ));

});

Route::post('/readings/reading', array(
    'as' => 'data',
    'uses' => 'ReadingsController@postReading'
));

Route::post('/account/FindPhone', array(
    'as' => 'phone',
    'uses' => 'AccountController@postFindPhone'
));

Route::group(array('before' => 'auth'), function(){

    Route::group(array('before' => 'csrf'), function(){

        Route::post('/readings/data', array(
            'as' => 'variable',
            'uses' => 'ReadingsController@postVariable'
        ));

        Route::post('/account/phonechange', array(
            'as' => 'account-phone-post',
            'uses' => 'AccountController@postPhone'
        ));

        Route::post('/account/password', array(
            'as' => 'account-password-post',
            'uses' => 'AccountController@postChangePassword'
        ));

    });

    Route::get('/account/logoff', array(
        'as' => 'account-logoff',
        'uses' => 'AccountController@getLogoff'
    ));

    Route::get('/account/pass', array(
        'as' => 'account-password',
        'uses' => 'AccountController@getChangePassword'
    ));

    Route::get('/account/phone', array(
        'as' => 'account-phone',
        'uses' => 'AccountController@getChangePhone'
    ));

    Route::get('/readings', array(
        'as' => 'readings',
        'uses' => 'ReadingsController@getIndex'
    ));

    Route::get('/set_threshold', array(
        'as' => 'form',
        'uses' => 'ReadingsController@getForm'
    ));

    Route::get('/backup', array(
        'as' => 'clean',
        'uses' => 'ReadingsController@getClean'
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

    //Route::Controller('readings', 'ReadingsController');    // present table and bar graph

});