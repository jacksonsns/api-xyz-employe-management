<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\FuncionarioController;
use App\Http\Controllers\api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/administrador', [FuncionarioController::class, 'index']);
Route::put('/{nome}/validar', [FuncionarioController::class, 'update']);
Route::get('/funcionarios/search', [FuncionarioController::class, 'search']);

Route::middleware(['auth:sanctum'])->group(function () {


    Route::post('/logout', [UserController::class, 'logout']);
});

Route::middleware(['guest'])->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/funcionarios/registrar', [FuncionarioController::class, 'store']);
});
