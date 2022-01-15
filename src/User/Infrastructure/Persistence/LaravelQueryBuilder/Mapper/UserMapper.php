<?php


namespace Src\User\Infrastructure\Persistence\LaravelQueryBuilder\Mapper;


use DateTime;
use Exception;
use Src\Shared\Domain\Exception\BadRequestException;
use Src\Shared\Domain\ValueObject\CountryId;
use Src\Shared\Domain\ValueObject\UserId;
use Src\User\Domain\Aggregate\User;
use Src\User\Domain\ValueObject\UserCreatedAt;
use Src\User\Domain\ValueObject\UserDetail;
use Src\User\Domain\ValueObject\UserDetailsFirstName;
use Src\User\Domain\ValueObject\UserDetailsLastName;
use Src\User\Domain\ValueObject\UserDetailsPhoneNumber;
use Src\User\Domain\ValueObject\UserEmail;
use Src\User\Domain\ValueObject\UserIsActive;
use Src\User\Domain\ValueObject\UserUpdatedAt;

class UserMapper
{

    /**
     * @param array $data
     * @return User
     * @throws BadRequestException
     * @throws Exception
     */
    public function __invoke(array $data): User
    {
        $userDetail = $this->buildUserDetails($data);
        return new User(
            new UserId($data['id']),
            new UserEmail($data['email']),
            new UserIsActive($data['active']),
            $userDetail,
            new UserCreatedAt(new DateTime($data['created_at'])),
            new UserUpdatedAt(new DateTime($data['updated_at'])),
        );
    }

    /**
     * @param array $data
     * @return UserDetail|null
     * @throws BadRequestException
     */
    private function buildUserDetails(array $data): ?UserDetail
    {
        $filteredData = array_filter($data, fn($value) => !is_null($value) && $value !== '');
        if (!array_key_exists('citizenship_country_id', $filteredData)) {
            return null;
        }

        return new UserDetail(
            new CountryId($filteredData['citizenship_country_id']),
            new UserDetailsFirstName($filteredData['first_name']),
            new UserDetailsLastName($filteredData['last_name']),
            new UserDetailsPhoneNumber($filteredData['phone_number']),
        );
    }

}
