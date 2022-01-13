<?php


namespace Src\Shared\Domain\Criteria\Pagination;



use Src\Shared\Domain\ValueObject\IntegerValueObject;

class PageSize extends IntegerValueObject
{

    const DEFAULT_PAGE_SIZE = 50;

    public static function default(): self
    {
        return new self(self::DEFAULT_PAGE_SIZE);
    }

}
