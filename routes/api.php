<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ModeradorController;
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

Route::get('usuario', [UsuarioController::class, 'get_all']);
Route::get('usuario/{id}', [UsuarioController::class, 'get']);
Route::post('usuario', [UsuarioController::class, 'create']);
Route::put('usuario/{id}', [UsuarioController::class, 'update']);
Route::delete('usuario/{id}', [UsuarioController::class, 'delete']);

Route::get('moderador', [ModeradorController::class, 'get_all']);
Route::get('moderador/{email}', [ModeradorController::class, 'get']);
Route::post('moderador', [ModeradorController::class, 'create']);
Route::put('moderador/{email}', [ModeradorController::class, 'update']);
Route::delete('moderador/{email}', [ModeradorController::class, 'delete']);