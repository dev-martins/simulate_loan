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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('simulation/')->namespace('App\Http\Controllers')->group(function () {
    Route::get('institutions', 'SimulationsController@getInstitutions')->name('getInstitutionsApi');
    Route::get('convenants', 'SimulationsController@getConvenants')->name('getConvenantsApi');
    Route::post('', 'SimulationsController@SimulationCredit')->name('SimulationCreditApi');
});
