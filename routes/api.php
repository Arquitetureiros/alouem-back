<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuarioController;
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