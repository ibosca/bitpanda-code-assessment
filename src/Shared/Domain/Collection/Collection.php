<?php


namespace Src\Shared\Domain\Collection;


abstract class Collection
{
    private array $items;

    public function __construct(...$items)
    {
        $this->items = $items;
    }

    abstract protected function type(): string;
    abstract public function values(): array;
    abstract public static function fromValues(): Collection;

    public function items(): array
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->items());
    }

    public function isEmpty(): bool
    {
        return empty($this->items());
    }

}
