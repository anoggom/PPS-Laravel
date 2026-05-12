<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FilmController extends Controller
{

    public function index(): JsonResponse
    {
        // En la paginación esta el valor null, para que laravel se encargue automaticamente de asignar el número de pagina.
        $peliculas = Film::paginate(15, ['*'], 'page', null, count(Film::all()));
        return response()->json($peliculas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $pelicula = Film::with('director')->findOrFail($id);
        return response()->json($pelicula);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
