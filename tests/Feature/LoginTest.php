<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function user_redirected_to_login_url_on_visit_of_root_url()
    {
        $this->get('/')
            ->assertRedirect('login');
    }

    /**
     * @test
     */
    public function user_can_login_with_valid_credentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'password')
        ]);

        $this->post('login', [
            'email' => $user->email,
            'password' => $password
        ]);

        $this->assertAuthenticatedAs($user);

    }

    /**
     * @test
     */
    public function user_cannot_login_with_invalid_credentials()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt($password = 'password')
        ]);

        $this->post('login', [
            'email' => $user->email,
            'password' => 'invalid password'
        ])->assertRedirect('/');
    }

    /**
     * @test
     */
    public function authenticated_user_can_logout()
    {
        $user = factory(User::class)->create();

        $this->be($user)->post('logout')
            ->assertRedirect('/');

        $this->assertFalse($this->isAuthenticated());
    }

}
