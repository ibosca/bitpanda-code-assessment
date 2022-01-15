<?php


namespace Src\User\Application;


use DateTime;
use Src\Shared\Domain\Exception\BadRequestException;
use Src\Shared\Domain\ValueObject\UserId;
use Src\User\Domain\Aggregate\User;
use Src\User\Domain\Repository\UserRepository;
use Src\User\Domain\ValueObject\UserDetail;
use Src\User\Domain\ValueObject\UserUpdatedAt;

class UserUpdater
{

    public function __construct(
        private UserRepository $repository
    ){}

    /**
     * @param UserId $id
     * @param UserDetail $detail
     * @throws BadRequestException
     */
    public function __invoke(UserId $id, UserDetail $detail): void
    {
        $user = $this->repository->findById($id);

        if (!$user->isEditable()) {
            throw new BadRequestException(['userId' => $id], 'User is not editable at this time');
        }

        $updatedUser = $this->buildUpdatedUser($user, $detail);

        $this->repository->update($updatedUser);

    }

    private function buildUpdatedUser(User $currentUser, UserDetail $newDetails): User
    {
        return new User(
          $currentUser->id(),
          $currentUser->email(),
          $currentUser->isActive(),
          $newDetails,
          $currentUser->createdAt(),
          new UserUpdatedAt(new DateTime())
        );
    }

}
