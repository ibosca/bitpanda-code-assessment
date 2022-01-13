<?php


namespace Src\User\Domain\Aggregate;


use Src\Shared\Domain\ValueObject\UserId;
use Src\User\Domain\ValueObject\UserCreatedAt;
use Src\User\Domain\ValueObject\UserDetails;
use Src\User\Domain\ValueObject\UserEmail;
use Src\User\Domain\ValueObject\UserIsActive;
use Src\User\Domain\ValueObject\UserUpdatedAt;

class User
{

    private UserId $id;
    private UserEmail $email;
    private UserIsActive $isActive;
    private ?UserDetails $details;
    private UserCreatedAt $createdAt;
    private UserUpdatedAt $updatedAt;

    public function __construct(
        UserId $id,
        UserEmail $email,
        UserIsActive $isActive,
        ?UserDetails $details,
        UserCreatedAt $createdAt,
        UserUpdatedAt $updatedAt
    )
    {
        $this->id = $id;
        $this->email = $email;
        $this->isActive = $isActive;
        $this->details = $details;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function isActive(): UserIsActive
    {
        return $this->isActive;
    }

    public function details(): ?UserDetails
    {
        return $this->details;
    }

    public function createdAt(): UserCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): UserUpdatedAt
    {
        return $this->updatedAt;
    }

}
