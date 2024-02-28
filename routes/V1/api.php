<?php

use App\Http\Controllers\V1\CurrencyAssetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('currency/assets')->name('currency.assets.')->group(function () {
    Route::get('/', [CurrencyAssetController::class, 'list'])->name('list');
    Route::post('/', [CurrencyAssetController::class, 'add'])->name('add');
    Route::get('/calculate', [CurrencyAssetController::class, 'calculate'])->name('calculate');
});




