<?php


namespace Src\Shared\Domain\Criteria\Filter;

use RuntimeException;
use Src\Shared\Domain\Collection\Collection;

class FilterCollection extends Collection
{
    public function __construct(Filter ...$filter)
    {
        parent::__construct(...$filter);
    }


    protected function type(): string
    {
        return FilterCollection::class;
    }

    public function values(): array
    {
        throw new RuntimeException('Not implemented!');
    }

    public static function fromValues(): Collection
    {
        throw new RuntimeException('Not implemented!');
    }
}
