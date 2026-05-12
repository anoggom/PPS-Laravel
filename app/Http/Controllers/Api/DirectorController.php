<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Director;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DirectorController extends Controller
{

    public function index(): JsonResponse
    {
        // En la paginación esta el valor null, para que laravel se encargue automaticamente de asignar el número de pagina.
        $directores = Director::paginate(15, ['*'], 'page', null, count(Director::all()));
        return response()->json($directores, 200);
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
        try {
            $director = Director::with('films')->findOrFail($id);
            return response()->json($director);
        } catch (ModelNotFoundException $e) {
            return response()->json('Director no encontrado.', 404);
        }
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
