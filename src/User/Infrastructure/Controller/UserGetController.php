<?php

namespace Src\User\Infrastructure\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Shared\Domain\Criteria\Criteria;
use Src\Shared\Domain\Criteria\Filter\Filter;
use Src\Shared\Domain\Criteria\Filter\FilterCollection;
use Src\User\Application\UserSearcher;
use Src\User\Infrastructure\Response\Transformer\UserTransformer;

class UserGetController extends Controller
{


    public function __construct(
        private UserSearcher $searcher,
        private UserTransformer $transformer,
    ){}

    public function __invoke(Request $request): JsonResponse
    {
        $criteria = $this->buildCriteria($request);

        $userCollection = $this->searcher->__invoke($criteria);

        return response()->json(
            $this->transformer->__invoke(...$userCollection->items())
        );

    }

    private function buildCriteria(Request $request): ?Criteria
    {
        $input = $request->query();
        $availableFilters = ['isActive', 'countryId'];

        $filters = [];

        foreach ($availableFilters as $availableFilter) {

            if (!array_key_exists($availableFilter, $input)) {
                continue;
            }

            $filters[] = Filter::equal($availableFilter, $input[$availableFilter]);
        }

        $filterCollection = new FilterCollection(...$filters);
        return new Criteria($filterCollection);

    }

}
