<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_con_credenciales_validas_devuelve_token(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
            ]);
    }

    public function test_login_con_credenciales_invalidas_devuelve_401(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(401)
            ->assertJsonMissingPath('file')
            ->assertJsonMissingPath('trace');
    }

    public function test_login_con_campos_faltantes_devuelve_422(): void
    {
        $response = $this->postJson('/api/auth/login', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password']);
    }

    public function test_logout_invalida_el_token(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $loginResponse = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $token = $loginResponse->json('access_token');

        $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->postJson('/api/auth/logout')
            ->assertStatus(200);

        $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->getJson('/api/auth/me')
            ->assertStatus(401);
    }

    public function test_refresh_devuelve_nuevo_token_valido(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $loginResponse = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $token = $loginResponse->json('access_token');

        $refreshResponse = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->postJson('/api/auth/refresh');

        $refreshResponse->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'token_type',
                'expires_in',
            ]);

        $newToken = $refreshResponse->json('access_token');

        $this->withHeaders(['Authorization' => 'Bearer ' . $newToken])
            ->getJson('/api/auth/me')
            ->assertStatus(200);
    }

    public function test_me_devuelve_datos_del_usuario_autenticado(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        $loginResponse = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $token = $loginResponse->json('access_token');

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->getJson('/api/auth/me');

        $response->assertStatus(200)
            ->assertJson([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ])
            ->assertJsonMissingPath('password');
    }

    public function test_acceso_sin_token_devuelve_401(): void
    {
        $response = $this->getJson('/api/directors');

        $response->assertStatus(401);
    }

    public function test_acceso_con_token_malformado_devuelve_401(): void
    {
        $response = $this->withHeaders(['Authorization' => 'Bearer token_inventado'])
            ->getJson('/api/directors');

        $response->assertStatus(401);
    }
}
