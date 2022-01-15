<?php


namespace Src\User\Domain\ValueObject;


use Src\Shared\Domain\ValueObject\CountryId;

class UserDetail
{

    private CountryId $countryId;
    private UserDetailsFirstName $firstName;
    private UserDetailsLastName $lastName;
    private UserDetailsPhoneNumber $phoneNumber;

    public function __construct(
        CountryId $countryId,
        UserDetailsFirstName $firstName,
        UserDetailsLastName $lastName,
        UserDetailsPhoneNumber $phoneNumber
    )
    {
        $this->countryId = $countryId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phoneNumber = $phoneNumber;
    }

    public function countryId(): CountryId
    {
        return $this->countryId;
    }

    public function firstName(): UserDetailsFirstName
    {
        return $this->firstName;
    }

    public function lastName(): UserDetailsLastName
    {
        return $this->lastName;
    }

    public function phoneNumber(): UserDetailsPhoneNumber
    {
        return $this->phoneNumber;
    }


}
