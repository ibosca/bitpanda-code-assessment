<?php


namespace Src\User\Domain\Repository;


use Src\Shared\Domain\Criteria\Criteria;
use Src\Shared\Domain\ValueObject\UserId;
use Src\User\Domain\Aggregate\User;
use Src\User\Domain\Collection\UserCollection;

interface UserRepository
{
    public function findById(UserId $id): User;
    public function searchByCriteria(Criteria $criteria): UserCollection;
    public function create(User $user): void;
    public function update(User $user): void;
    public function remove(User $user): void;

}
