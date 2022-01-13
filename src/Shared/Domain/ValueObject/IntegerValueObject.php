<?php


namespace Src\Shared\Domain\ValueObject;


class IntegerValueObject
{
    protected int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function isGreaterThan(IntegerValueObject $integerValueObject): bool
    {
        return $this->value > $integerValueObject->value();
    }

    public function equals(IntegerValueObject $integerValueObject): bool
    {
        return $this->value() === $integerValueObject->value();
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }

}
