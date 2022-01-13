<?php


namespace Src\Shared\Domain\Criteria\Order;



use Src\Shared\Domain\ValueObject\StringValueObject;

class OrderModifier extends StringValueObject
{
    public const ORDER_ASC = 'asc';
    public const ORDER_DESC = 'desc';
    public const ORDER_NONE = 'none';

    public function __construct(string $value)
    {
        parent::__construct($value);
    }

    public static function asc(): self
    {
        return new self(self::ORDER_ASC);
    }

    public static function desc(): self
    {
        return new self(self::ORDER_DESC);
    }

    public static function none(): self
    {
        return new self(self::ORDER_NONE);
    }

    public function isNone(): bool
    {
        return $this->value() === self::ORDER_NONE;
    }


}
