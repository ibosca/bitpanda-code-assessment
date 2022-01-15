<?php


namespace Src\Shared\Domain\Exception;

class NotFoundException extends BitpandaException
{

    const TITLE = 'NOT_FOUND_EXCEPTION';
    const DESCRIPTION = 'Not found';
    const HTTP_CODE = 404;

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
