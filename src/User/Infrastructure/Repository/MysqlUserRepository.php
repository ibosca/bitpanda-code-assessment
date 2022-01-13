<?php


namespace Src\User\Infrastructure\Repository;


use RuntimeException;
use Src\Shared\Domain\Criteria\Criteria;
use Src\Shared\Domain\ValueObject\UserId;
use Src\User\Domain\Aggregate\User;
use Src\User\Domain\Collection\UserCollection;
use Src\User\Domain\Repository\UserRepository;

class MysqlUserRepository implements UserRepository
{

    public function findById(UserId $id): User
    {
        throw new RuntimeException('Not implemented!');
    }

    public function searchByCriteria(Criteria $criteria): UserCollection
    {
        return new UserCollection();
    }

    public function update(User $user): void
    {
    }

    public function remove(User $user): void
    {
    }
}
