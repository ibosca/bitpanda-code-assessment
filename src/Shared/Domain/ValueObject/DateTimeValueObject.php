<?php


namespace Src\Shared\Domain\ValueObject;

use DateTime;

class DateTimeValueObject
{
    protected DateTime $value;

    public function __construct(DateTime $value)
    {
        $this->value = $value;
    }

    public function value(): DateTime
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value()->format(DATE_ISO8601);
    }


}
