<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\User\Domain\Repository\UserRepository;
use Src\User\Infrastructure\Repository\MysqlUserRepository;

class AppServiceProvider extends ServiceProvider
{

    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        UserRepository::class => MysqlUserRepository::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
