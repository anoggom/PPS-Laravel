<?php

namespace Tests\Feature\Peliculas;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Director;
use App\Models\Film;

class PeliculaTest extends TestCase
{
    use RefreshDatabase;

    private function autenticar(): string
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        return $response->json('access_token');
    }

    public function test_listar_peliculas_autenticado_devuelve_coleccion(): void
    {
        $token = $this->autenticar();

        Film::factory()->count(3)->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->getJson('/api/films');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'title', 'release_date', 'sinopsis', 'duration', 'gendre', 'director_id'],
                ],
            ]);
    }

    public function test_crear_pelicula_asociada_a_director_existente(): void
    {
        $token = $this->autenticar();

        $director = Director::factory()->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->postJson('/api/films', [
                'title' => 'Inception',
                'release_date' => '2010-07-16',
                'sinopsis' => 'Un ladrón que roba secretos del subconsciente.',
                'duration' => 148,
                'gendre' => 'Ciencia Ficción',
                'director_id' => $director->id,
            ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('films', [
            'title' => 'Inception',
            'director_id' => $director->id,
        ]);
    }

    public function test_crear_pelicula_con_director_inexistente_devuelve_422(): void
    {
        $token = $this->autenticar();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->postJson('/api/films', [
                'title' => 'Test',
                'release_date' => '2020-01-01',
                'sinopsis' => 'Sinopsis de prueba.',
                'duration' => 120,
                'gendre' => 'Drama',
                'director_id' => 9999,
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['director_id']);
    }

    public function test_actualizar_pelicula(): void
    {
        $token = $this->autenticar();

        $film = Film::factory()->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->putJson("/api/films/{$film->id}", [
                'title' => 'Título Actualizado',
            ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('films', [
            'id' => $film->id,
            'title' => 'Título Actualizado',
        ]);
    }

    public function test_eliminar_pelicula(): void
    {
        $token = $this->autenticar();

        $film = Film::factory()->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->deleteJson("/api/films/{$film->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('films', [
            'id' => $film->id,
        ]);
    }

    public function test_mostrar_pelicula_incluye_datos_del_director(): void
    {
        $token = $this->autenticar();

        $director = Director::factory()->create([
            'name' => 'Christopher',
            'surname' => 'Nolan',
        ]);

        $film = Film::factory()->create([
            'director_id' => $director->id,
        ]);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->getJson("/api/films/{$film->id}");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'director' => ['id', 'name'],
            ]);
    }
}
