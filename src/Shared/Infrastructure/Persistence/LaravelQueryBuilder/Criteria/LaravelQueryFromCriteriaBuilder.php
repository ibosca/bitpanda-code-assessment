<?php


namespace Src\Shared\Infrastructure\Persistence\LaravelQueryBuilder\Criteria;


use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use RuntimeException;
use Src\Shared\Domain\Criteria\Criteria;
use Src\Shared\Domain\Criteria\Filter\Filter;
use Src\Shared\Domain\Criteria\Filter\FilterCollection;
use Src\Shared\Domain\Exception\BadRequestException;
use Src\User\Domain\Aggregate\User;
use Src\User\Domain\ValueObject\UserDetail;

class LaravelQueryFromCriteriaBuilder
{

    const DEPENDANT_ENTITIES = [
        User::class => [
            UserDetail::class => 'user_id'
        ]
    ];

    const DOMAIN_FIELDS_TO_DATABASE_FIELDS = [
        User::class => [
            'id' => 'users.id',
            'email' => 'users.email',
            'isActive' => 'users.active',
            'createdAt' => 'users.created_at',
            'updatedAt' => 'users.updated_at',
            'countryId' => 'user_details.citizenship_country_id',
            'firstName' => 'user_details.first_name',
            'lastName' => 'user_details.last_name',
            'phoneNumber' => 'user_details.phone_number',
        ]
    ];

    public function __invoke(Criteria $criteria, string $aggregate): Builder
    {
        $tableName = $this->aggregateNameToDatabaseTableName($aggregate);
        $query = DB::table($tableName);
        $query = $this->joinDependantEntities($query, $aggregate);
        $query = $this->addFieldsToSelect($query, $aggregate);
        $query = $this->addWhereClauses($query, $criteria->filters(), $aggregate);

        return $query;
    }

    private function joinDependantEntities(Builder $query, string $aggregate): Builder
    {
        $resourceTable = $this->aggregateNameToDatabaseTableName($aggregate);
        $dependantEntities = self::DEPENDANT_ENTITIES[$aggregate];

        foreach ($dependantEntities as $dependantEntity => $relatedFieldInDependantEntity) {
            $dependantDatabaseTable = $this->aggregateNameToDatabaseTableName($dependantEntity);

            $query->leftJoin(
                "{$dependantDatabaseTable}",
                "{$resourceTable}.id",
                '=',
                "{$dependantDatabaseTable}.{$relatedFieldInDependantEntity}"
            );
        }

        return $query;
    }

    private function addFieldsToSelect(Builder $query, string $aggregate): Builder
    {
        $query->select(self::DOMAIN_FIELDS_TO_DATABASE_FIELDS[$aggregate]);
        return $query;
    }

    private function addWhereClauses(Builder $query, FilterCollection $filters, string $aggregate): Builder
    {
        $whereClauses = [];

        /** @var Filter $filter */
        foreach ($filters->items() as $filter) {

            $databaseField = self::DOMAIN_FIELDS_TO_DATABASE_FIELDS[$aggregate][$filter->field()->value()];

            if (!$databaseField) {
                throw new BadRequestException([], "Field was not found: {$filter->field()}");
            }

            $whereClauses[] = [$databaseField, $filter->operator()->value(), $filter->value()->value()];
        }

        $query->where($whereClauses);
        return $query;
    }

    private function aggregateNameToDatabaseTableName(string $aggregate): string
    {


        $qualifiedClassParts = explode('\\', $aggregate);
        $aggregateShortName = end($qualifiedClassParts);

        $snakeCase = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $aggregateShortName));

        return $snakeCase.'s';
    }
}
