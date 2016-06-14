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
    return view('welcome');
});

Route::group(['middleware' => 'throttle:100', 'prefix' => 'api', 'namespace' => 'Api', 'as' => 'api.'], function () {
    Route::group(['prefix' => 'v1', 'namespace' => 'V1', 'as' => 'v1.'], function () {
        Route::get('cep/busca-por-cep/{cep}', ['as' => 'cep.busca_por_cep',
            'uses' => 'CepController@buscaEnderecoPorCep']
            )->where(['cep' => '[0-9]+']);

        Route::get('cep/busca-por-logradouro/{logradouro}', ['as' => 'cep.busca_por_logradouro',
            'uses' => 'CepController@buscaCepPorLogradouro']
            )->where(['logradouro' => '[0-9a-zA-Z ]+']);
    });
});
