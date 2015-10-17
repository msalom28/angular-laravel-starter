<?php

//Load SPA
Route::get('/', function () {
    return view('app');
});


Route::group(['prefix' => 'api'], function(){
	//Authenticate routes...
	Route::post('authenticate', 'AuthenticateController@authenticate');
	Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
	//Property routes...
	Route::get('properties', 'PropertyController@index');
});
