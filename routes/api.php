<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



// Route::group(['middleware' => ['jwt.verify']], function() {
	
//     });

    Route::post('login','ApiController@login');
    Route::get('user', 'ApiController@userProfile'); 
    Route::post('postuser', 'ApiController@postUserProfile'); 
    Route::post('me', 'ApiController@me'); 
    Route::post('logout', 'ApiController@logout');
    Route::post('refresh', 'ApiController@refresh');

// Route::group([

//     'prefix' => 'auth'
// ], function () {
//     Route::post('login', 'ApiController@login');
//     Route::post('logout', 'ApiController@logout');
//     Route::post('refresh', 'ApiController@refresh');
//     Route::post('me', 'ApiController@me');

// });

