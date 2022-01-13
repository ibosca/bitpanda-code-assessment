<?php


namespace Src\User\Domain\Collection;


use RuntimeException;
use Src\Shared\Domain\Collection\Collection;
use Src\User\Domain\Aggregate\User;

class UserCollection extends Collection
{
    public function __construct(User ...$users)
    {
        parent::__construct(...$users);
    }

    protected function type(): string
    {
        return UserCollection::class;
    }

    public function values(): array
    {
        throw new RuntimeException('Not implemented!');
    }

    public static function fromValues(): UserCollection
    {
        throw new RuntimeException('Not implemented!');
    }
}
