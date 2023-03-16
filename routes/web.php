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

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [App\Http\Controllers\AuthController::class, 'loginShow'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::get('/admin/companies', [App\Http\Controllers\CompanyController::class, 'index']);
    Route::post('/admin/companies', [App\Http\Controllers\CompanyController::class, 'store']);
    Route::get('/admin/companies/create', [App\Http\Controllers\CompanyController::class, 'create']);
    Route::get('/admin/companies/{id}', [App\Http\Controllers\CompanyController::class, 'show']);
    Route::delete('/admin/companies/{id}', [App\Http\Controllers\CompanyController::class, 'destroy']);
    Route::get('/admin/companies/{id}/edit', [App\Http\Controllers\CompanyController::class, 'edit']);
    Route::put('/admin/companies/{id}', [App\Http\Controllers\CompanyController::class, 'update']);
    Route::get('/admin/workers', [App\Http\Controllers\WorkerController::class, 'index']);
    Route::get('/admin/workers/create', [App\Http\Controllers\WorkerController::class, 'create']);
    Route::get('/admin/workers/{id}', [App\Http\Controllers\WorkerController::class, 'show']);
    Route::get('/admin/workers/{id}/edit', [App\Http\Controllers\WorkerController::class, 'edit']);
    Route::put('/admin/workers/{id}', [App\Http\Controllers\WorkerController::class, 'update']);
    Route::post('/admin/workers', [App\Http\Controllers\WorkerController::class, 'store']);
    Route::delete('/admin/workers/{id}', [App\Http\Controllers\WorkerController::class, 'destroy']);
});
