<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_register_with_valid_credentials()
    {
        $this->withoutExceptionHandling();

        $data = [
            'email' => 'demo@example.com',
            'password' => 'password',
            'name' => 'John Doe'
        ];

        $this->from('/register')->post('/register', $data );

        $this->assertDatabaseHas('users', [
            'email' => $data['email']
        ]);
    }

    /** @test */
    public function email_is_required_to_register()
    {
        $data = [
            'email' => '',
            'password' => 'password',
            'name' => 'random'
        ];

        $response = $this->from('/register')->post('/register', $data );

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function duplicate_email_is_not_allowed()
    {
        $data = [
            'email' => 'demo@example.com',
            'name' => 'Jane Doe',
            'password' => 'password',
            'username' => 'username'
        ];

        User::factory()->create($data);
        
        $response = $this->from('/register')->post('/register', $data );

        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function password_is_required_to_register()
    {
        $data = [
            'email' => 'demo@example.com',
            'name' => 'Jane Doe',
            'password' => '',
            'username' => 'username'
        ];

        $response = $this->from('/register')->post('/register', $data );

        $response->assertSessionHasErrors(['password']);
    }
}
