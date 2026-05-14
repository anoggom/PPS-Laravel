<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Director;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function index(): JsonResponse
    {
        $directores = Director::paginate(15, ['*'], 'page', null, count(Director::all()));
        return response()->json($directores, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date'],
        ]);

        $director = Director::create($validated);

        return response()->json($director, 201);
    }

    public function show(int $id): JsonResponse
    {
        try {
            $director = Director::with('films')->findOrFail($id);
            return response()->json($director);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Director no encontrado.'], 404);
        }
    }

    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $director = Director::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Director no encontrado.'], 404);
        }

        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'surname' => ['sometimes', 'required', 'string', 'max:255'],
            'birthdate' => ['sometimes', 'required', 'date'],
        ]);

        $director->update($validated);

        return response()->json($director, 200);
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $director = Director::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Director no encontrado.'], 404);
        }

        if ($director->films()->exists()) {
            return response()->json([
                'error' => 'No se puede eliminar el director porque tiene películas asociadas.'
            ], 409);
        }

        $director->delete();

        return response()->json(null, 204);
    }
}
