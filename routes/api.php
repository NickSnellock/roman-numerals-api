<?php

use App\Http\Controllers\Api\NumeralConversionController;
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

Route::post('/convert/{convertThis}', [NumeralConversionController::class, 'convertNumber'])
    ->middleware('convert');
Route::get('/top-ten', [NumeralConversionController::class, 'getTopTen']);
Route::get('/recent/{startDate?}', [NumeralConversionController::class, 'getRecent'])
    ->middleware('recent');
