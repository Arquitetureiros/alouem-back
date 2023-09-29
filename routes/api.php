<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ModeradorController;
use App\Http\Controllers\PublicacaoController;
use App\Http\Controllers\FotoController;
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

Route::get('publicacao', [PublicacaoController::class, 'get_all']);
Route::get('publicacao/{id}', [PublicacaoController::class, 'get']);
Route::post('publicacao', [PublicacaoController::class, 'create']);
Route::put('publicacao/{id}', [PublicacaoController::class, 'update']);
Route::delete('publicacao/{id}', [PublicacaoController::class, 'delete']);

Route::get('foto', [FotoController::class, 'get_all']);
Route::get('foto/{id}', [FotoController::class, 'get']);
Route::post('foto', [FotoController::class, 'create']);
Route::put('foto/{id}', [FotoController::class, 'update']);
Route::delete('foto/{id}', [FotoController::class, 'delete']);
