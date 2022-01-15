<?php


namespace Src\User\Infrastructure\Persistence\LaravelQueryBuilder\Repository;


use Illuminate\Support\Facades\DB;
use Src\Shared\Domain\Criteria\Criteria;
use Src\Shared\Domain\Criteria\Filter\Filter;
use Src\Shared\Domain\Criteria\Filter\FilterCollection;
use Src\Shared\Domain\Exception\BadRequestException;
use Src\Shared\Domain\Exception\NotFoundException;
use Src\Shared\Domain\ValueObject\UserId;
use Src\Shared\Infrastructure\Persistence\LaravelQueryBuilder\Criteria\LaravelQueryFromCriteriaBuilder;
use Src\User\Domain\Aggregate\User;
use Src\User\Domain\Collection\UserCollection;
use Src\User\Domain\Repository\UserRepository;
use Src\User\Infrastructure\Persistence\LaravelQueryBuilder\Mapper\UserMapper;
use stdClass;

class LaravelQueryBuilderUserRepository implements UserRepository
{

    public function __construct(
        private LaravelQueryFromCriteriaBuilder $builder,
        private UserMapper $mapper
    ){}

    /**
     * @param UserId $id
     * @return User
     * @throws BadRequestException
     * @throws NotFoundException
     */
    public function findById(UserId $id): User
    {
        $filters = new FilterCollection(
            Filter::equal('id', $id->value())
        );

        $criteria = new Criteria($filters);

        $query = $this->builder->__invoke($criteria, User::class);
        $result = $query->get();

        if ($result->isEmpty()) {
            throw new NotFoundException(['id' => $id->value()], "User not found!");
        }

        $userDataList = $result->toArray();
        return $this->mapper->__invoke(get_object_vars(reset($userDataList)));

    }

    /**
     * @param Criteria $criteria
     * @return UserCollection
     * @throws BadRequestException
     */
    public function searchByCriteria(Criteria $criteria): UserCollection
    {
        $query = $this->builder->__invoke($criteria, User::class);
        $result = $query->get();

        $users = array_map(
            fn (stdClass $data): User => $this->mapper->__invoke(get_object_vars($data)),
            $result->toArray()
        );

        return new UserCollection(...$users);
    }


    public function update(User $user): void
    {
        DB::table('user_details')
            ->where('user_id', $user->id()->value())
            ->update([
                'citizenship_country_id' => $user->detail()->countryId()->value(),
                'first_name' => $user->detail()->firstName()->value(),
                'last_name' => $user->detail()->lastName()->value(),
                'phone_number' => $user->detail()->phoneNumber()->value(),
            ]);
    }

    public function remove(User $user): void
    {
        DB::table('users')
            ->where('id', '=', $user->id()->value())
            ->delete();
    }
}
