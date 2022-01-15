<?php

namespace Tests\User\Application;

use PHPUnit\Framework\TestCase;
use Src\Shared\Domain\Exception\BadRequestException;
use Src\Shared\Domain\ValueObject\CountryId;
use Src\User\Application\UserUpdater;
use Src\User\Domain\Aggregate\User;
use Src\User\Domain\Repository\UserRepository;
use Src\User\Domain\ValueObject\UserDetail;
use Src\User\Domain\ValueObject\UserDetailsFirstName;
use Src\User\Domain\ValueObject\UserDetailsLastName;
use Src\User\Domain\ValueObject\UserDetailsPhoneNumber;
use Tests\User\Domain\UserMother;

class UserUpdaterTest extends TestCase
{
    public function test_should_edit_user()
    {

        $user = UserMother::withDetail();
        $updatedDetails = new UserDetail(
            new CountryId('12'),
            new UserDetailsFirstName('AA'),
            new UserDetailsLastName('BB'),
            new UserDetailsPhoneNumber('0023453454354')
        );

        $repository = $this->createMock(UserRepository::class);
        $repository
            ->expects($this->once())
            ->method('findById')
            ->with($this->equalTo($user->id()))
            ->will($this->returnValue($user));

        $repository
            ->expects($this->once())
            ->method('update')
            ->with($this->callback(
                function(User $subject) use ($updatedDetails) {
                    return $subject->detail() == $updatedDetails;
                })
            )
            ->will($this->returnValue(null));

        $sut = new UserUpdater($repository);

        $sut->__invoke($user->id(), $updatedDetails);
    }


    public function test_should_not_edit_user()
    {

        $user = UserMother::withoutDetail();
        $updatedDetails = new UserDetail(
            new CountryId('12'),
            new UserDetailsFirstName('AA'),
            new UserDetailsLastName('BB'),
            new UserDetailsPhoneNumber('0023453454354')
        );

        $repository = $this->createMock(UserRepository::class);
        $repository
            ->expects($this->once())
            ->method('findById')
            ->with($this->equalTo($user->id()))
            ->will($this->returnValue($user));

        $this->expectException(BadRequestException::class);

        $sut = new UserUpdater($repository);

        $sut->__invoke($user->id(), $updatedDetails);
    }
}
