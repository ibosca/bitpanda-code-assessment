<?php

namespace Src\Shared\Domain\ValueObject;


use Src\Shared\Domain\Exception\BadRequestException;

class EmailValueObject extends StringValueObject
{


    /**
     * @param string $value
     * @throws BadRequestException
     */
    public function __construct(string $value)
    {
        $this->ensureIsValidEmail($value);
        parent::__construct($value);
    }

    /**
     * @param string $value
     * @throws BadRequestException
     */
    private function ensureIsValidEmail(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new BadRequestException(['email' => $value, 'Email provided is not valid']);
        }
    }

}
