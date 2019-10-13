<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * @test
     */
    public function user_redirected_to_login_url_on_visit_of_root_url()
    {
        $this->get('/')
            ->assertRedirect('login');
    }
}
