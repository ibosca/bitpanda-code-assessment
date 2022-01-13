<?php


namespace Src\User\Application;


use Src\Shared\Domain\Criteria\Criteria;
use Src\User\Domain\Collection\UserCollection;
use Src\User\Domain\Repository\UserRepository;

class UserSearcher
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }


    public function __invoke(Criteria $criteria): UserCollection
    {
        return $this->repository->searchByCriteria($criteria);
    }
}
