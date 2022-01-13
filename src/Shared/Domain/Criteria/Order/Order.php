<?php


namespace Src\Shared\Domain\Criteria\Order;


class Order
{
    private OrderBy $orderBy;
    private OrderModifier $modifier;

    public function __construct(OrderBy $orderBy, OrderModifier $modifier)
    {
        $this->orderBy = $orderBy;
        $this->modifier = $modifier;
    }

    public static function none(): self
    {
        return new self(
            new OrderBy(''),
            OrderModifier::none(),
        );
    }

    public function orderBy(): OrderBy
    {
        return $this->orderBy;
    }

    public function modifier(): OrderModifier
    {
        return $this->modifier;
    }

    public function isNone(): bool
    {
        return $this->modifier->isNone();
    }


}
