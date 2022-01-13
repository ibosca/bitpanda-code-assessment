<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\Shared\Domain\Criteria\Criteria;
use Src\Shared\Domain\Criteria\Filter\Filter;
use Src\Shared\Domain\Criteria\Filter\FilterCollection;
use Src\User\Application\UserSearcher;

class UserGetController extends Controller
{
    private UserSearcher $searcher;

    public function __construct(UserSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke(Request $request)
    {
        $criteria = $this->buildCriteria($request);
        $users = $this->searcher->__invoke($criteria);
    }

    private function buildCriteria(Request $request): ?Criteria
    {
        $input = $request->query();

        $filters = [];

        if (array_key_exists('isActive', $input)) {
            $filters[] = Filter::equal('isActive', $input['isActive']);
        }

        if (array_key_exists('citizenship', $input)) {
            $filters[] = Filter::equal('citizenship', $input['citizenship']);
        }

        $filterCollection = new FilterCollection(...$filters);
        return new Criteria($filterCollection);

    }

}
