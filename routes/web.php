<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/','App\Http\Controllers\HomeController@index')->name('dashboard');

Route::view('/seetings', 'home')->middleware(['auth', 'verified']);

Route::view('/profile/edit', 'profile.edit')->middleware('auth');

Route::view('/profile/password', 'profile.password')->middleware('auth');

Route::get('/register/{token}','App\Http\Controllers\Auth\Admin\RegisterController@showRegisterForm')->name('register.form');

Route::post('/register','App\Http\Controllers\Auth\Admin\RegisterController@postRegister')->name('register');

Route::middleware('auth')->group( function (){

    Route::get('/register','App\Http\Controllers\Auth\Admin\RegisterController@getEmailRegister')->name('register.request');
    
    Route::post('/register/email','App\Http\Controllers\Auth\Admin\RegisterController@sendEmailRegister')->name('sendEmail.register');

    Route::get('egresados','App\Http\Controllers\Admin\EgresadosController@allEgresados')->name('egresados.filtrar');

    Route::get('/egresados/{id}/delete','App\Http\Controllers\Admin\EgresadosController@deleteEgresado')->name('egresados.delete');
    
    Route::get('tramites','App\Http\Controllers\Admin\TramitesController@allTramites')->name('tramite.filtrar');

    Route::get('/tramites/{id}/','App\Http\Controllers\Admin\TramitesController@getTramites')->name('egresados.tramites');

    Route::get('/tramite/{id}/finalizar','App\Http\Controllers\Admin\TramitesController@finishTramite')->name('tramite.finish');
    
    Route::get('/tramites/{id}/delete','App\Http\Controllers\Admin\TramitesController@deleteTramite')->name('tramites.delete');
    
    Route::get('citas','App\Http\Controllers\Admin\CitasController@allCitas')->name('citas.filtrar');
    
    Route::get('/citas/{id}/','App\Http\Controllers\Admin\CitasController@getCitas')->name('egresados.citas');
    
    Route::post('/citas/{id}','App\Http\Controllers\Admin\CitasController@postCitar')->name('citar');

    Route::get('/citas/{id}/delete','App\Http\Controllers\Admin\CitasController@deleteCita')->name('citas.delete');
    
    Route::get('citasNoEnviadas','App\Http\Controllers\Admin\CitasController@getCitasNoEnviadas')->name('citas.noEnviadas');
    
    Route::post('sendCitasPendientes','App\Http\Controllers\Admin\CitasController@sendMailsRestantes')->name('citas.enviarPendientes');

    Route::get('crearTramite','App\Http\Controllers\Admin\ListTramitesController@getCreateTramite')->name('listaTramites');

    Route::post('createListaTramite','App\Http\Controllers\Admin\ListTramitesController@storeTramite')->name('listaTramites.store');
    
    Route::get('deleteListaTramite/{id}/delete','App\Http\Controllers\Admin\ListTramitesController@deleteListaTramite')->name('listraTramites.delete');

    Route::get('editListaTramite/{id}/edit','App\Http\Controllers\Admin\ListTramitesController@editListaTramite')->name('listraTramites.edit');

    Route::patch('updateNameTramite/{id}/update','App\Http\Controllers\Admin\ListTramitesController@updateNameTramite')->name('listraTramites.update');

    Route::get('downloadEgresados/{carrera}/{yearIngreso}/{yearEgreso}/{dateIngresoRange}/{dateEgresoRange}/{dateIngresoSpe}/{dateEgresoSpe}',[
        'as' => 'download.egresados',
        'uses' => 'App\Http\Controllers\Admin\DownloadsFilesController@downloadEgresados'
    ]);

    Route::get('downloadTramites/{tramite}/{carrera}/{yearIngreso}/{yearEgreso}/
    {dateIngresoRange}/{dateEgresoRange}/{dateIngresoSpe}/{dateEgresoSpe}',[
        'as' => 'download.tramites',
        'uses' => 'App\Http\Controllers\Admin\DownloadsFilesController@downloadTramites'
    ]);

    Route::get('downloadCitas/{tramite}/{carrera}',[
        'as' => 'download.citas',
        'uses' => 'App\Http\Controllers\Admin\DownloadsFilesController@downloadCitas'
    ]);

    Route::get('tramites_emails/{tramite}/{carrera}/{yearIngreso}/{yearEgreso}/
    {dateIngresoRange}/{dateEgresoRange}/{dateIngresoSpe}/{dateEgresoSpe}',[
        'as' => 'tramites_emails',
        'uses' => 'App\Http\Controllers\Admin\CitasController@getMails'
    ]);

    Route::post('sendEmails/{tramite}/{carrera}/{yearIngreso}/{yearEgreso}/
    {dateIngresoRange}/{dateEgresoRange}/{dateIngresoSpe}/{dateEgresoSpe}',[
        'as'   => 'citar.sendEmail',
        'uses' => 'App\Http\Controllers\Admin\CitasController@sendEmails'
    ]);
});