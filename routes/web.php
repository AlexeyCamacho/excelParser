<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ExcelImportController;
use App\Http\Controllers\ShowRowsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth.basic'])->group(function () {
    Route::controller(ExcelImportController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/importExcelFile', 'importFile');
    });
});

Route::controller(ShowRowsController::class)->group(function () {
    Route::get('/show', 'show');
});

