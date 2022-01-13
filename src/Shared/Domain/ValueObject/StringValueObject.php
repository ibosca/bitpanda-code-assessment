<?php


namespace Src\Shared\Domain\ValueObject;


class StringValueObject
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value();
    }

    public function equals(StringValueObject $stringValueObject): bool
    {
        return $this->value() === $stringValueObject->value();
    }

}
