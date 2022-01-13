<?php


namespace Src\Shared\Domain\Exception;

use Exception;

abstract class BitpandaException extends Exception
{
    private string $title;
    private string $description;
    private ?array $context;

    public function __construct(string $title, string $description, ?array $context)
    {
        $this->title = $title;
        $this->description = $description;
        $this->context = $context;

        parent::__construct($description);
    }

    abstract public function httpCode(): int;

    public function title(): string
    {
        return $this->title;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function context(): ?array
    {
        return $this->context;
    }


}
