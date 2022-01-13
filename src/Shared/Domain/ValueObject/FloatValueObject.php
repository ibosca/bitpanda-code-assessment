<?php


namespace Src\Shared\Domain\ValueObject;


class FloatValueObject
{
    protected float $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function value(): float
    {
        return $this->value;
    }

    public function isGreaterThan(FloatValueObject $floatValueObject): float
    {
        return $this->value > $floatValueObject->value();
    }

    public function __toString(): string
    {
        return (string) $this->value();
    }

}
