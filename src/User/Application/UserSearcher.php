<?php


namespace Src\User\Application;


use Src\Shared\Domain\Criteria\Criteria;

class UserSearcher
{
    public function __invoke(Criteria $criteria): array
    {
        dump('AL USE CASE!');
    }
}
