<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\ExcelController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('login.loginView');
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'dashboardView');
    Route::post('/dashboard', 'dashboardView');
});

Route::post('/upload-excel/{type}', [ExcelController::class, 'upload']);
Route::post('/changeConnection', [DatabaseController::class, 'changeConnection']);
Route::post('/fetchDataFromApi', [ApiController::class, 'fetchDataFromApi']);