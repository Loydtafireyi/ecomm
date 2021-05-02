<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Tests\CreatesApplication;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    use CreatesApplication;
    use RefreshDatabase;
    use DatabaseMigrations;

    public function setUp() : void
    {
        parent::setUp();
        Artisan::call('passport:install');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_register()
    {
        $this->withoutExceptionHandling();

        $user = [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post('/api/register/', $user);

        $response->assertStatus(200);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('users', ['email' => 'john@doe.com']);
    }

    public function test_user_can_login()
    {
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@doe.com',
        ]);

        $loginFormData = [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
        ];

        $this->json('POST', 'api/login', $loginFormData, ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
}
