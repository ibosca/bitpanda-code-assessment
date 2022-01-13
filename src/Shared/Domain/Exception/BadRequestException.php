<?php


namespace Src\Shared\Domain\Exception;

class BadRequestException extends BitpandaException
{

    const TITLE = 'BAD_REQUEST_EXCEPTION';
    const DESCRIPTION = 'Invalid request message';
    const HTTP_CODE = 400;

    public function __construct(?array $context = null, ?string $description = null)
    {
        parent::__construct(
            self::TITLE,
            $description ?? self::DESCRIPTION,
            $context
        );
    }


    public function httpCode(): int
    {
        return self::HTTP_CODE;
    }

}
