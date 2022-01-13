<?php


namespace Src\Shared\Domain\Criteria\Pagination;



use Src\Shared\Domain\ValueObject\IntegerValueObject;

class PageNumber extends IntegerValueObject
{
    public static function initial(): self
    {
        return new self(1);
    }
}
