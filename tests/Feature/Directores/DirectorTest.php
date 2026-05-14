<?php

namespace Tests\Feature\Directores;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Director;
use App\Models\Film;

class DirectorTest extends TestCase
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

    public function test_listar_directores_requiere_autenticacion(): void
    {
        $response = $this->getJson('/api/directors');

        $response->assertStatus(401);
    }

    public function test_listar_directores_autenticado_devuelve_coleccion(): void
    {
        $token = $this->autenticar();

        Director::factory()->count(3)->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->getJson('/api/directors');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'surname', 'birthdate'],
                ],
            ]);
    }

    public function test_crear_director_con_datos_validos(): void
    {
        $token = $this->autenticar();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->postJson('/api/directors', [
                'name' => 'Christopher',
                'surname' => 'Nolan',
                'birthdate' => '1970-07-30',
            ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('directors', [
            'name' => 'Christopher',
            'surname' => 'Nolan',
            'birthdate' => '1970-07-30',
        ]);
    }

    public function test_crear_director_con_datos_invalidos_devuelve_422(): void
    {
        $token = $this->autenticar();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->postJson('/api/directors', [
                'name' => '',
                'surname' => '',
                'birthdate' => '',
            ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'surname', 'birthdate']);
    }

    public function test_actualizar_director_existente(): void
    {
        $token = $this->autenticar();

        $director = Director::factory()->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->putJson("/api/directors/{$director->id}", [
                'name' => 'Nombre Actualizado',
            ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('directors', [
            'id' => $director->id,
            'name' => 'Nombre Actualizado',
        ]);
    }

    public function test_actualizar_director_inexistente_devuelve_404(): void
    {
        $token = $this->autenticar();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->putJson('/api/directors/9999', [
                'name' => 'Nuevo nombre',
            ]);

        $response->assertStatus(404);
    }

    public function test_eliminar_director_existente(): void
    {
        $token = $this->autenticar();

        $director = Director::factory()->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->deleteJson("/api/directors/{$director->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('directors', [
            'id' => $director->id,
        ]);
    }

    public function test_eliminar_director_con_peliculas_asociadas(): void
    {
        $token = $this->autenticar();

        $director = Director::factory()->create();
        Film::factory()->create(['director_id' => $director->id]);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->deleteJson("/api/directors/{$director->id}");

        $response->assertStatus(409);

        $this->assertDatabaseHas('directors', [
            'id' => $director->id,
        ]);
    }
}
