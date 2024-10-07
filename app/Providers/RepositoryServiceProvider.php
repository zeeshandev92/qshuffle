<?php

namespace App\Providers;

use App\Interfaces\{
    PlanRepositoryInterface,
    QuestionRepositoryInterface,
    RelationRepositoryInterface,
    RoleRepositoryInterface
};
use App\Repositories\{
    PlanRepository,
    RelationRepository,
    RoleRepository,
    QuestionRepository
};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RelationRepositoryInterface::class, RelationRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
        $this->app->bind(PlanRepositoryInterface::class, PlanRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
