<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use App\Models\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_post_must_have_an_author()
    {
        $post = Post::factory()->make();

        $this->assertNotNull($post);
        $this->assertInstanceOf(User::class, $post->user);
    }
}
