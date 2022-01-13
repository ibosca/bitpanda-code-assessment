<?php


namespace Src\Shared\Domain\ValueObject;


class ArrayValueObject
{
    protected array $value;

    public function __construct(array $value)
    {
        $this->value = $value;
    }

    public function value(): array
    {
        return $this->value;
    }

}
