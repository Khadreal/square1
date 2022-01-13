<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test*/
    public function must_be_able_to_view_a_login_form()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('frontend.auth.login');
    }

    /**
     * @test
    */
    public function must_not_be_able_to_login_with_invalid_password()
    {
        $user = User::factory()->make();

        $data = [
            'identity' => $user->email,
            'password' => ''
        ];

        $response = $this->from('/login')->post('/login', $data );

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors(['password']);
        $response->assertSessionHasInput('identity');
    }

    /** @test */
    public function must_not_be_able_to_login_with_invalid_email()
    {

        $user = User::factory()->make();

        $data = [
            'identity' => 'invalid@email.com',
            'password' => $user->password
        ];

        $response = $this->from('/login')->post('/login', $data );

        $response->assertRedirect('/login');
        $response->assertSessionHasInput('identity');
        $response->assertSessionHasInput('password');
    }

    /** @test */
    public function email_is_required_to_login()
    {
        $user = User::factory()->make();

        $data = [
            'identity' => '',
            'password' => $user->password
        ];

        $response = $this->from('/login')->post('/login', $data );
        $response->assertSessionHasErrors(['identity']);
        $response->assertRedirect('/login');
    }

    /** @test */
    public function password_is_required_to_login()
    {
        $user = User::factory()->make();

        $data = [
            'identity' => $user->identity,
            'password' => ''
        ];

        $response = $this->from('/login')->post('/login', $data );
        $response->assertSessionHasErrors(['password']);
        $response->assertRedirect('/login');
    }

    /** @test */
    public function can_find_user_using_email_and_password()
    {
        $user  = User::factory()->make();

        $authUser = Auth::attempt(['email' => $user->email, 'password' => $user->password]);

        $this->assertNotNull($authUser);
    }
}
