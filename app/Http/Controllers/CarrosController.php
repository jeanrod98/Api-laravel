<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carros;

class CarrosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Consulta a la API de Carros
        $cars = Carros::all();
        return $cars;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Almacenar datos de un carro
        $carro = new Carros();

        $carro->marca = $request->marca;
        $carro->modelo = $request->modelo;
        $carro->anio = $request->anio;
        $carro->precio = $request->precio;

        $carro->save();

        return $carro;

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //Actualizar registro de la api

        $carro = Carros::findOrFail($request->id);

        $carro->marca = $request->marca;
        $carro->modelo = $request->modelo;
        $carro->anio = $request->anio;
        $carro->precio = $request->precio;

        $carro->save();

        return $carro;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //Elimina un registro de la API

        $carro = Carros::destroy($request->id);

        return $carro;
    }
}
