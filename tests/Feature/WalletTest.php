<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WalletTest extends TestCase
{
    use DatabaseMigrations;
    // use RefreshDatabase;
   
    public function test_user_can_top_wallet()
    {
        // $this->withoutExceptionHandling();

        // $user = User::factory()->create();

        // $response = $this->actingAs($user)->post('/api/topup', [
        //     'amount' => 200,
        // ]);

        // $response->assertOk();

        // $response->assertStatus(200);
    }
}
