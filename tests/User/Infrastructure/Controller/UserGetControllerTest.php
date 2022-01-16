<?php

namespace Tests\User\Infrastructure\Controller;

use Tests\TestCase;

class UserGetControllerTest extends TestCase
{

    public function test_users_endpoint_returns_a_success_response()
    {
        $response = $this->get('/api/users?isActive=1&countryId=1');

        $response->assertStatus(200);
    }
}
