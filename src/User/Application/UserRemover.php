<?php


namespace Src\User\Application;


use Src\Shared\Domain\Exception\BadRequestException;
use Src\Shared\Domain\ValueObject\UserId;
use Src\User\Domain\Repository\UserRepository;

class UserRemover
{

    public function __construct(
        private UserRepository $repository
    ){}

    /**
     * @param UserId $id
     * @throws BadRequestException
     */
    public function __invoke(UserId $id): void
    {
        $user = $this->repository->findById($id);

        if (!$user->isRemovable()) {
            throw new BadRequestException(['userId' => $id], 'User is not removable at this time');
        }

        $this->repository->remove($user);

    }

}
