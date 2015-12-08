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

Route::get('/home', array('as' =>'home', 'uses' => 'StudentController@homepage'));

Route::get('/signup','StudentController@signup');
Route::post('signup_update','StudentController@UpdateSignup');

Route::get('/editTeam/{id}','StudentController@editTeam');
Route::post('updateTeam','StudentController@updateTeam');

Route::get('/team/{id}','StudentController@team');
Route::post('updateTeamName','StudentController@updateTeamName');

Route::get('/studentInfo','StudentController@studentInfo');

Route::get('/edit', 'StudentController@editInfoPage');
Route::post('update','StudentController@UpdateInfoPage');

Route::get('/students' , 'StudentController@viewStudents');
Route::get('/students/{id}' , 'StudentController@viewStudent');


Route::post('generate', 'StudentController@generateTeam');
//Route::get('')
