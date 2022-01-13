<?php

namespace Tests\User\Application;

use PHPUnit\Framework\TestCase;
use Src\Shared\Domain\Criteria\Criteria;
use Src\Shared\Domain\Criteria\Filter\FilterCollection;
use Src\User\Application\UserSearcher;
use Src\User\Domain\Collection\UserCollection;
use Src\User\Domain\Repository\UserRepository;

class UserSearcherTest extends TestCase
{
    public function test_search_for_users()
    {

        $criteria = new Criteria(new FilterCollection());

        $repository = $this->createMock(UserRepository::class);
        $repository
            ->expects($this->once())
            ->method('searchByCriteria')
            ->with($this->equalTo($criteria))
            ->will($this->returnValue(new UserCollection()));

        $sut = new UserSearcher($repository);

        $sut->__invoke($criteria);
    }
}
