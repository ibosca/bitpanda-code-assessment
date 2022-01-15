<?php

namespace Src\Shared\Domain\ValueObject;


use Src\Shared\Domain\Exception\BadRequestException;

class PhoneValueObject extends StringValueObject
{


    /**
     * @param string $value
     * @throws BadRequestException
     */
    public function __construct(string $value)
    {
        $this->ensureIsValidPhone($value);
        parent::__construct($value);
    }

    /**
     * @param string $value
     * @throws BadRequestException
     */
    private function ensureIsValidPhone(string $value): void
    {
        if (strlen($value) < 8) {
            throw new BadRequestException(['phone' => $value], 'Phone length not valid!');
        }
    }

}
