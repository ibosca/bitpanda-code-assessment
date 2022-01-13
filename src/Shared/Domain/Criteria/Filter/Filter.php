<?php


namespace Src\Shared\Domain\Criteria\Filter;


class Filter
{
    private FilterField $field;
    private FilterOperator $operator;
    private FilterValue $value;

    public function __construct(
        FilterField $field,
        FilterOperator $operator,
        FilterValue $value
    )
    {
        $this->field = $field;
        $this->operator = $operator;
        $this->value = $value;
    }

    public function field(): FilterField
    {
        return $this->field;
    }

    public function operator(): FilterOperator
    {
        return $this->operator;
    }

    public function value(): FilterValue
    {
        return $this->value;
    }

    public static function greaterThan(string $field, string $value): self
    {
        return new Filter(new FilterField($field), FilterOperator::greaterThan(), new FilterValue($value));
    }

    public static function lessThan(string $field, string $value): self
    {
        return new Filter(new FilterField($field), FilterOperator::lessThan(), new FilterValue($value));
    }

    public static function contains(string $field, string $value): self
    {
        return new Filter(new FilterField($field), FilterOperator::contains(), new FilterValue($value));
    }

    public static function notEqual(string $field, string $value): self
    {
        return new Filter(new FilterField($field), FilterOperator::notEqual(), new FilterValue($value));
    }

    public static function in(string $field, string ...$values): self
    {
        return new Filter(new FilterField($field), FilterOperator::in(), new FilterValue($values));
    }

    public static function notIn(string $field, string ...$values): self
    {
        return new Filter(new FilterField($field), FilterOperator::notIn(), new FilterValue($values));
    }

    public static function equal(string $field, string $value): self
    {
        return new Filter(new FilterField($field), FilterOperator::equal(), new FilterValue($value));
    }

}
