<?php


namespace Src\Shared\Domain\Criteria;


use Src\Shared\Domain\Criteria\Filter\FilterCollection;
use Src\Shared\Domain\Criteria\Order\Order;
use Src\Shared\Domain\Criteria\Pagination\Pagination;

class Criteria
{
    private FilterCollection $filters;
    private Order $order;
    private Pagination $pagination;

    public function __construct(
        FilterCollection $filters,
        ?Order $order = null,
        ?Pagination $pagination = null,
    )
    {
        $this->filters = $filters;
        $this->order = $order ?? Order::none();
        $this->pagination = $pagination ?? Pagination::initial();
    }

    public function filters(): FilterCollection
    {
        return $this->filters;
    }

    public function order(): Order
    {
        return $this->order;
    }

    public function pagination(): Pagination
    {
        return $this->pagination;
    }
}
