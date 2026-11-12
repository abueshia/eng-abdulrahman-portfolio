<?php

/**
 * RepositoryServiceProvider
 *
 * Binds all Repository Interfaces (Contracts) to their concrete Eloquent
 * implementations for Dependency Injection across Services and Controllers.
 */

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * All repository interface-to-implementation bindings.
     * Domain-specific bindings will be populated in Phase 3 and Phase 4.
     *
     * @var array<class-string, class-string>
     */
    public array $bindings = [];

    /**
     * Register repository bindings in the container.
     */
    public function register(): void
    {
        foreach ($this->bindings as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    /**
     * Bootstrap any repository services.
     */
    public function boot(): void
    {
        //
    }
}

