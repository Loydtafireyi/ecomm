<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class WalletTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
 
    public function test_wallet_belong_to_user()
    {
        $wallet = Wallet::factory()->create();

        $this->assertInstanceOf(User::class, $wallet->user);
    }
}
