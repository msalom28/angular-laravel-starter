<?php

//Load SPA
Route::get('/', function () {
    return view('spa');
});


Route::group(['prefix' => 'api'], function(){
	Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
	Route::post('authenticate', 'AuthenticateController@authenticate');
	Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
});
