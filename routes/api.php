<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarrosController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Rutas para la API de CARROS

// todo: Endpoin para consultar registros
Route::get("/carros", [CarrosController::class, "index"]);
// todo: Endpoin para guardar registros
Route::post("/carros", [CarrosController::class, "store"]);
// todo: Endpoin para actualizar registros
Route::put("/carros/{id}", [CarrosController::class, "update"]);
// todo: Endpoin para eliminar registros
Route::delete("/carros/{id}",  [CarrosController::class, "destroy"]);