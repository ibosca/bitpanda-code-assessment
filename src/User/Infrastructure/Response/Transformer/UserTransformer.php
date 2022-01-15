<?php


namespace Src\User\Infrastructure\Response\Transformer;


use Src\User\Domain\Aggregate\User;
use Src\User\Domain\ValueObject\UserDetail;

class UserTransformer
{
    public function __invoke(User ...$users): array
    {
        return array_map(fn(User $user): array => $this->transform($user), $users);
    }

    private function transform(User $user): array {
        return [
            'id' => $user->id()->value(),
            'email' => $user->email()->value(),
            'isActive' => $user->isActive()->value(),
            'detail' => $this->transformDetail($user->detail()),
            'createdAt' => $user->createdAt()->__toString(),
            'updatedAt' => $user->updatedAt()->__toString()
        ];
    }

    private function transformDetail(?UserDetail $detail): ?array
    {
        if (!$detail) {
            return null;
        }

        return [
            'countryId' => $detail->countryId()->value(),
            'firstName' => $detail->firstName()->value(),
            'lastName' => $detail->lastName()->value(),
            'phoneNumber' => $detail->phoneNumber()->value()
        ];
    }
}
