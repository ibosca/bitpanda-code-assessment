<?php


namespace App\Http\Controllers;


use Src\User\Application\UserSearcher;

class UserGetController extends Controller
{
    private UserSearcher $searcher;

    public function __construct(UserSearcher $searcher)
    {
        $this->searcher = $searcher;
    }

    public function __invoke()
    {
        $this->searcher->__invoke();
    }

}
