<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['jwt.verify']], function() {
    
    Route::get('/estadoFormulario/{id}','App\Http\Controllers\User\EgresadoController@getFormulario');

    Route::post('/formulario','App\Http\Controllers\User\EgresadoController@setFormulario');

    Route::patch('/updateFormulario/{id}','App\Http\Controllers\User\EgresadoController@updateFormulario');
    
    Route::get('/getTramites/{id}','App\Http\Controllers\User\EgresadoController@getTramites');
    
    Route::post('/postTramite','App\Http\Controllers\User\EgresadoController@setTramite');
    
    Route::get('/getCitas/{id}','App\Http\Controllers\User\EgresadoController@getCitas');
});

Route::post('login','App\Http\Controllers\Auth\User\AuthController@login');
    
Route::post('/logout','App\Http\Controllers\Auth\User\AuthController@logout');

Route::post('register','App\Http\Controllers\Auth\User\AuthController@register');

Route::post('reset/password','App\Http\Controllers\Auth\User\ForgotUserPasswordController@sendResetLinkEmail');

Route::post('update/password','App\Http\Controllers\Auth\User\ForgotUserPasswordController@updatePassword');