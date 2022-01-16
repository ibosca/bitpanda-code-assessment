<?php

namespace Tests\User\Infrastructure\Controller;

use Tests\TestCase;

class UserDeleteControllerTest extends TestCase
{

    public function test_user_is_deleted()
    {
        $createRequest = $this->postJson(
            '/api/users/99',
            [
                "email"=> "isaacbncl@gmail.com",
                "isActive" => true,
            ]
        );

        $createRequest->assertStatus(201);

        $deleteRequest = $this->delete('/api/users/99');
        $deleteRequest->assertStatus(201);
    }
}
