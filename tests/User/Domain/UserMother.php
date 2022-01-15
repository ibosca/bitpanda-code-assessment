<?php


namespace Tests\User\Domain;


use DateTime;
use Src\Shared\Domain\ValueObject\CountryId;
use Src\Shared\Domain\ValueObject\UserId;
use Src\User\Domain\Aggregate\User;
use Src\User\Domain\ValueObject\UserCreatedAt;
use Src\User\Domain\ValueObject\UserDetail;
use Src\User\Domain\ValueObject\UserDetailsFirstName;
use Src\User\Domain\ValueObject\UserDetailsLastName;
use Src\User\Domain\ValueObject\UserDetailsPhoneNumber;
use Src\User\Domain\ValueObject\UserEmail;
use Src\User\Domain\ValueObject\UserIsActive;
use Src\User\Domain\ValueObject\UserUpdatedAt;

class UserMother
{

    public static function editable(): User
    {
        return new User(
            new UserId('44'),
            new UserEmail('editable@user.com'),
            new UserIsActive(true),
            new UserDetail(
                new CountryId('76'),
                new UserDetailsFirstName('Editable'),
                new UserDetailsLastName('User'),
                new UserDetailsPhoneNumber('00345678987652')
            ),
            new UserCreatedAt(new DateTime()),
            new UserUpdatedAt(new DateTime())
        );
    }

    public static function nonEditable(): User
    {
        return new User(
            new UserId('47'),
            new UserEmail('non-editable@user.com'),
            new UserIsActive(true),
            null,
            new UserCreatedAt(new DateTime()),
            new UserUpdatedAt(new DateTime())
        );
    }

}
