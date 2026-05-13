<?php

namespace Tests\Feature\Security;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Facades\JWTAuth;

class SecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_token_expirado_devuelve_401(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('password'),
        ]);

        Config::set('jwt.ttl', 1);
        JWTAuth::factory()->setTTL(1);

        $loginResponse = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $token = $loginResponse->json('access_token');

        Auth::guard('api')->logout();

        $this->travel(2)->minutes();

        $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->getJson('/api/auth/me')
            ->assertStatus(401);
    }

    public function test_respuestas_de_error_no_exponen_stack_trace(): void
    {
        $response = $this->getJson('/api/directors');

        $response->assertStatus(401);
        $response->assertJsonMissingPath('file');
        $response->assertJsonMissingPath('line');
        $response->assertJsonMissingPath('trace');
    }

    public function test_password_no_aparece_en_respuesta_me(): void
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

        $response->assertStatus(200);
        $response->assertJsonMissingPath('password');
    }
}
