<?php


namespace Src\User\Application;


use DateTime;
use Src\Shared\Domain\Criteria\Criteria;
use Src\Shared\Domain\Criteria\Filter\Filter;
use Src\Shared\Domain\Criteria\Filter\FilterCollection;
use Src\Shared\Domain\Exception\BadRequestException;
use Src\Shared\Domain\ValueObject\UserId;
use Src\User\Domain\Aggregate\User;
use Src\User\Domain\Repository\UserRepository;
use Src\User\Domain\ValueObject\UserCreatedAt;
use Src\User\Domain\ValueObject\UserDetail;
use Src\User\Domain\ValueObject\UserEmail;
use Src\User\Domain\ValueObject\UserIsActive;
use Src\User\Domain\ValueObject\UserUpdatedAt;

class UserCreator
{

    public function __construct(
        private UserRepository $repository
    ){}

    /**
     * @param UserId $id
     * @param UserEmail $email
     * @param UserIsActive $isActive
     * @param UserDetail|null $detail
     * @throws BadRequestException
     */
    public function __invoke(
        UserId $id,
        UserEmail $email,
        UserIsActive $isActive,
        ?UserDetail $detail
    ): void
    {
        $this->ensureUserIsNotAlreadyCreated($id);
        $user = $this->buildUser($id, $email, $isActive, $detail);
        $this->repository->create($user);
    }

    /**
     * @param UserId $id
     * @throws BadRequestException
     */
    private function ensureUserIsNotAlreadyCreated(UserId $id): void
    {
        $criteria = new Criteria(
            new FilterCollection(
                Filter::equal('id', $id->value())
            )
        );
        $users = $this->repository->searchByCriteria($criteria);

        if (!$users->isEmpty()) {
            throw new BadRequestException(['userId' => $id], 'There is already a user with this Id in the database.');
        }
    }

    private function buildUser(
        UserId $id,
        UserEmail $email,
        UserIsActive $isActive,
        ?UserDetail $detail
    ): User
    {
        return new User(
          $id,
          $email,
          $isActive,
          $detail,
          new UserCreatedAt(new DateTime()),
          new UserUpdatedAt(new DateTime()),
        );
    }

}
