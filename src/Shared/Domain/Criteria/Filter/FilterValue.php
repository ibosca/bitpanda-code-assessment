<?php

namespace Src\Shared\Domain\Criteria\Filter;

class FilterValue
{

    private mixed $value;

    public function __construct(mixed $value)
    {
        $this->value = $value;
    }

    public function value(): mixed
    {
        return $this->value;
    }

}
