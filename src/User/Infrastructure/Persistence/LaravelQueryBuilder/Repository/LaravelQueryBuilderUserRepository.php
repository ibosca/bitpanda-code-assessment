<?php


namespace Src\User\Infrastructure\Persistence\LaravelQueryBuilder\Repository;


use RuntimeException;
use Src\Shared\Domain\Criteria\Criteria;
use Src\Shared\Domain\Exception\BadRequestException;
use Src\Shared\Domain\ValueObject\UserId;
use Src\Shared\Infrastructure\Persistence\LaravelQueryBuilder\Criteria\LaravelQueryFromCriteriaBuilder;
use Src\User\Domain\Aggregate\User;
use Src\User\Domain\Collection\UserCollection;
use Src\User\Domain\Repository\UserRepository;
use Src\User\Infrastructure\Persistence\LaravelQueryBuilder\Mapper\UserMapper;
use stdClass;

class LaravelQueryBuilderUserRepository implements UserRepository
{

    public function __construct(
        private LaravelQueryFromCriteriaBuilder $builder,
        private UserMapper $mapper
    ){}

    public function findById(UserId $id): User
    {
        throw new RuntimeException('Not implemented!');
    }

    /**
     * @param Criteria $criteria
     * @return UserCollection
     * @throws BadRequestException
     */
    public function searchByCriteria(Criteria $criteria): UserCollection
    {
        $query = $this->builder->__invoke($criteria, User::class);
        $result = $query->get();

        $users = array_map(
            fn (stdClass $data): User => $this->mapper->__invoke(get_object_vars($data)),
            $result->toArray()
        );

        return new UserCollection(...$users);
    }


    public function update(User $user): void
    {
    }

    public function remove(User $user): void
    {
    }
}
