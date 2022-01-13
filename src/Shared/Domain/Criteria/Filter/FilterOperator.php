<?php


namespace Src\Shared\Domain\Criteria\Filter;


use Src\Shared\Domain\ValueObject\StringValueObject;

class FilterOperator extends StringValueObject
{
    public const EQUAL        = '=';
    public const NOT_EQUAL    = '!=';
    public const GREATER_THAN = '>';
    public const LESS_THAN    = '<';
    public const CONTAINS     = '∈';
    public const IN           = '⊂';
    public const NOT_IN       = '⊄';

    public function __construct(string $value)
    {
        parent::__construct($value);
    }

    public static function equal(): self
    {
        return new self(self::EQUAL);
    }

    public static function notEqual(): self
    {
        return new self(self::NOT_EQUAL);
    }

    public static function greaterThan(): self
    {
        return new self(self::GREATER_THAN);
    }

    public static function lessThan(): self
    {
        return new self(self::LESS_THAN);
    }

    public static function contains(): self
    {
        return new self(self::CONTAINS);
    }

    public static function in(): self
    {
        return new self(self::IN);
    }

    public static function notIn(): self
    {
        return new self(self::NOT_IN);
    }


}
