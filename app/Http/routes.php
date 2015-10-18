<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
  return redirect()->route('cube.index');
});
Route::resource('cube', 'CubeController');
Route::post('cube/{id}/query/', 'CubeController@query');
Route::post('cube/upload/', 'CubeFileController@upload');
Route::get('cube/{id}/download/', 'CubeFileController@download');

