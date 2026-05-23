<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index(): JsonResponse
    {
        $peliculas = Film::paginate(15, ['*'], 'page', null, count(Film::all()));

        return response()->json($peliculas, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'release_date' => ['required', 'date'],
            'sinopsis' => ['required', 'string'],
            'duration' => ['required', 'integer', 'min:1'],
            'gendre' => ['required', 'string', 'max:100'],
            'director_id' => ['required', 'integer', 'exists:directors,id'],
        ]);

        $film = Film::create($validated);

        return response()->json($film, 201);
    }

    public function show(int $id): JsonResponse
    {
        try {
            $pelicula = Film::with('director')->findOrFail($id);

            return response()->json($pelicula, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Película no encontrada.'], 404);
        }
    }

    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $film = Film::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Película no encontrada.'], 404);
        }

        $validated = $request->validate([
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'release_date' => ['sometimes', 'required', 'date'],
            'sinopsis' => ['sometimes', 'required', 'string'],
            'duration' => ['sometimes', 'required', 'integer', 'min:1'],
            'gendre' => ['sometimes', 'required', 'string', 'max:100'],
            'director_id' => ['sometimes', 'required', 'integer', 'exists:directors,id'],
        ]);

        $film->update($validated);

        return response()->json($film, 200);
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $film = Film::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Película no encontrada.'], 404);
        }

        $film->delete();

        return response()->json(null, 204);
    }
}
