<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticiaController;

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

Route::middleware('check.news')->group(function () {
    Route::get('/noticias/{id}', [NoticiaController::class, 'show']);
    Route::patch('/noticias/{id}', [NoticiaController::class, 'update']);
    Route::patch('/noticias/{id}/review', [NoticiaController::class, 'review']);
    Route::delete('/noticias/{id}', [NoticiaController::class, 'destroy']);
});

Route::controller(NoticiaController::class)->group(function () {
    Route::get('/noticias', 'index');
    Route::get('/dev/noticias/all', 'all');
    Route::post('/noticias', 'create');
});
