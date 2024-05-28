<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FicheController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\EquipementController;

Route::resource('equipements', EquipementController::class);
Route::get('equipements-deleted', [EquipementController::class, 'deleted']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/show/{id}', [UserController::class, 'show']);
Route::get('/search', [UserController::class, 'search']);
Route::get('/index', [UserController::class, 'index']);
Route::put('/update/{id}', [UserController::class, 'update']);
Route::delete('/delete/{id}', [UserController::class, 'destroy']);
Route::post('/password/reset', [PasswordResetController::class, 'sendResetLink']);
Route::post('/password/reset/{token}', [PasswordResetController::class, 'resetPassword']);
Route::get('deleted-fiches', [FicheController::class, 'getDeletedFiches']);


Route::resource('fiches', FicheController::class);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
