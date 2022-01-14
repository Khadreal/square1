<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_have_many_posts()
    {
        $user = User::factory()
            ->has(Post::factory()->count(3))
            ->create();

        $this->assertNotNull($user->posts);

        $this->assertEquals(3, $user->posts()->count());
    }
}
