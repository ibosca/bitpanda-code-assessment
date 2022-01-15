<?php

namespace Src\User\Infrastructure\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Shared\Domain\Exception\BadRequestException;
use Src\Shared\Domain\ValueObject\CountryId;
use Src\Shared\Domain\ValueObject\UserId;
use Src\User\Application\UserUpdater;
use Src\User\Domain\ValueObject\UserDetail;
use Src\User\Domain\ValueObject\UserDetailsFirstName;
use Src\User\Domain\ValueObject\UserDetailsLastName;
use Src\User\Domain\ValueObject\UserDetailsPhoneNumber;

class UserPostController extends Controller
{


    public function __construct(
        private UserUpdater $updater,
    ){}

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws BadRequestException
     */
    public function __invoke(Request $request): JsonResponse
    {

        $this->validateRequest($request);

        $userId = new UserId($request->route('userId'));
        $userDetail = $this->buildUserDetail($request->post());

        $this->updater->__invoke($userId, $userDetail);

        return response()
            ->json(null)
            ->setStatusCode(201);

    }

    /**
     * @param Request $request
     * @throws BadRequestException
     */
    private function validateRequest(Request $request): void
    {
        $data = $request->post();
        $mandatoryFields = ["countryId", "firstName", "lastName", "phoneNumber"];

        foreach ($mandatoryFields as $mandatoryField) {
            if (!array_key_exists($mandatoryField, $data)) {
                throw new BadRequestException(null, "Mandatory fiels {$mandatoryField} not provided.");
            }
        }

    }

    /**
     * @param array $data
     * @return UserDetail
     * @throws BadRequestException
     */
    private function buildUserDetail(array $data): UserDetail
    {
        return new UserDetail(
            new CountryId($data["countryId"]),
            new UserDetailsFirstName($data["firstName"]),
            new UserDetailsLastName($data["lastName"]),
            new UserDetailsPhoneNumber($data["phoneNumber"])
        );
    }

}
