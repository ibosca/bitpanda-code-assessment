<?php

namespace Src\User\Infrastructure\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Shared\Domain\Exception\BadRequestException;
use Src\Shared\Domain\ValueObject\UserId;
use Src\User\Application\UserRemover;

class UserDeleteController extends Controller
{

    public function __construct(
        private UserRemover $remover,
    ){}

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws BadRequestException
     */
    public function __invoke(Request $request): JsonResponse
    {

        $userId = new UserId($request->route('userId'));

        $this->remover->__invoke($userId);

        return response()
            ->json(null)
            ->setStatusCode(201);

    }

}
