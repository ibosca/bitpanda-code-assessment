<?php

namespace Tests\User\Application;

use PHPUnit\Framework\TestCase;
use Src\Shared\Domain\Exception\BadRequestException;
use Src\User\Application\UserRemover;
use Src\User\Domain\Repository\UserRepository;
use Tests\User\Domain\UserMother;

class UserRemoverTest extends TestCase
{
    public function test_should_remove_user()
    {

        $user = UserMother::withoutDetail();

        $repository = $this->createMock(UserRepository::class);
        $repository
            ->expects($this->once())
            ->method('findById')
            ->with($this->equalTo($user->id()))
            ->will($this->returnValue($user));

        $repository
            ->expects($this->once())
            ->method('remove')
            ->with($this->equalTo($user))
            ->will($this->returnValue(null));

        $sut = new UserRemover($repository);

        $sut->__invoke($user->id());
    }


    public function test_should_not_remove_user()
    {

        $user = UserMother::withDetail();

        $repository = $this->createMock(UserRepository::class);
        $repository
            ->expects($this->once())
            ->method('findById')
            ->with($this->equalTo($user->id()))
            ->will($this->returnValue($user));

        $this->expectException(BadRequestException::class);

        $sut = new UserRemover($repository);

        $sut->__invoke($user->id());
    }
}
