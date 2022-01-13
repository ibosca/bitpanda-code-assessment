<?php

namespace Tests\User\Infrastructure\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserGetEndpointTest extends TestCase
{

    public function test_users_endpoint_returns_a_success_response()
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);
    }
}
