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

Route::get('/', 'StudentController@homepage');


Route::controllers ([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('home', 'StudentController@homepage');


Route::get('studentInfo','StudentController@studentInfo');
Route::get('edit', 'StudentController@editInfoPage');
Route::post('update','StudentController@UpdateInfoPage');

Route::post('generate', 'StudentController@generateTeam');
//Route::get('')
