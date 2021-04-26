<?php

namespace Tests\Unit;

use App\Models\Topup;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class TopupTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function test_topup_belong_to_user()
    {
        $topup = Topup::factory()->create();

        $this->assertInstanceOf(User::class, $topup->user);
    }
}
