<?php

use App\Http\Controllers\UsuariosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarrosController;



    //**  RUTAS PUBLICAS
    // todo: Endpoin para consultar registros
    Route::get("/carros", [CarrosController::class, "index"]);
    // todo: Autenticacion
    Route::post("/auth",  [UsuariosController::class, "create"]);


    //! RUTAS PRIVADAS
    // Rutas para la API de CARROS
    // todo: Endpoin para guardar registros
    Route::post("/carros", [CarrosController::class, "store"])->middleware('jwt');
    // todo: Endpoin para actualizar registros
    Route::put("/carros/{id}", [CarrosController::class, "update"])->middleware('jwt');
    // todo: Endpoin para eliminar registros
    Route::delete("/carros/{id}",  [CarrosController::class, "destroy"])->middleware('jwt');

    // Rutas de usuario
    // todo: Endpoin para obtener datos de perfil
    Route::get("/perfil",  [UsuariosController::class, "profile"])->middleware('jwt');
    // todo: Endpoin para cerrar sesion
    Route::post("/logout",  [UsuariosController::class, "destroy"])->middleware('jwt');


    



