<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\ScheduledVacancyController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/vacancies', [VacancyController::class, 'index']);
Route::post('/vacancies', [VacancyController::class, 'store']);
Route::get('/vacancies/{id}', [VacancyController::class, 'get']);
Route::put('/vacancies/{id}', [VacancyController::class, 'update']);
Route::delete('/vacancies/{id}', [VacancyController::class, 'destroy']);

Route::get('/scheduled-vacancies', [ScheduledVacancyController::class, 'index']);
Route::get('/scheduled-vacancies/{id}', [ScheduledVacancyController::class, 'get']);
Route::post('/scheduled-vacancies', [ScheduledVacancyController::class, 'store']);
Route::put('/scheduled-vacancies/{id}', [ScheduledVacancyController::class, 'update']);
Route::delete('/scheduled-vacancies/{id}', [ScheduledVacancyController::class, 'destroy']);
