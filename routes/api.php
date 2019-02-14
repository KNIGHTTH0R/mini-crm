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

Route::post('login', 'Api\UserController@login');

Route::group(['middleware' => ['json', 'auth:api', 'is-admin']], function () {
    Route::post('details', 'Api\UserController@details');

    Route::resource('company',  'Api\CompanyController' )->except(['update']);
    Route::resource('employee', 'Api\EmployeeController');

    /*
     * Методом PUT нельзя обновить логотип, создаём аналог с методом POST
     * */

    Route::post('company/{company}/update',  'Api\CompanyController@updateWithImage' );
});
