<?php


namespace Src\Shared\Domain\Criteria\Pagination;


class Pagination
{
    private PageNumber $pageNumber;
    private PageSize $pageSize;

    public function __construct(PageNumber $pageNumber, PageSize $pageSize)
    {
        $this->pageNumber = $pageNumber;
        $this->pageSize = $pageSize;
    }

    public static function initial(): self
    {
        return new self(
            PageNumber::initial(),
            PageSize::default(),
        );
    }

    public static function fromValues(int $pageNuber, int $pageSize): self
    {
        return new self(
            new PageNumber($pageNuber),
            new PageSize($pageSize)
        );
    }

    public function pageNumber(): PageNumber
    {
        return $this->pageNumber;
    }

    public function pageSize(): PageSize
    {
        return $this->pageSize;
    }


}
