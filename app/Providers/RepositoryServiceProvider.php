<?php

/**
 * RepositoryServiceProvider
 *
 * Binds all Repository Interfaces (Contracts) to their concrete Eloquent
 * implementations for Dependency Injection across Services and Controllers.
 */

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\Contracts\BlogRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ContactMessageRepositoryInterface;
use App\Repositories\Contracts\CredentialRepositoryInterface;
use App\Repositories\Contracts\ExperienceRepositoryInterface;
use App\Repositories\Contracts\FaqRepositoryInterface;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use App\Repositories\Contracts\SettingRepositoryInterface;
use App\Repositories\Contracts\StatRepositoryInterface;
use App\Repositories\Contracts\TechnologyRepositoryInterface;
use App\Repositories\Contracts\TestimonialRepositoryInterface;
use App\Repositories\Eloquent\EloquentBlogRepository;
use App\Repositories\Eloquent\EloquentCategoryRepository;
use App\Repositories\Eloquent\EloquentContactMessageRepository;
use App\Repositories\Eloquent\EloquentCredentialRepository;
use App\Repositories\Eloquent\EloquentExperienceRepository;
use App\Repositories\Eloquent\EloquentFaqRepository;
use App\Repositories\Eloquent\EloquentProjectRepository;
use App\Repositories\Eloquent\EloquentServiceRepository;
use App\Repositories\Eloquent\EloquentSettingRepository;
use App\Repositories\Eloquent\EloquentStatRepository;
use App\Repositories\Eloquent\EloquentTechnologyRepository;
use App\Repositories\Eloquent\EloquentTestimonialRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * All repository interface-to-implementation bindings.
     *
     * @var array<class-string, class-string>
     */
    public array $bindings = [
        SettingRepositoryInterface::class => EloquentSettingRepository::class,
        ProjectRepositoryInterface::class => EloquentProjectRepository::class,
        TechnologyRepositoryInterface::class => EloquentTechnologyRepository::class,
        ExperienceRepositoryInterface::class => EloquentExperienceRepository::class,
        CredentialRepositoryInterface::class => EloquentCredentialRepository::class,
        ServiceRepositoryInterface::class => EloquentServiceRepository::class,
        TestimonialRepositoryInterface::class => EloquentTestimonialRepository::class,
        CategoryRepositoryInterface::class => EloquentCategoryRepository::class,
        BlogRepositoryInterface::class => EloquentBlogRepository::class,
        ContactMessageRepositoryInterface::class => EloquentContactMessageRepository::class,
        FaqRepositoryInterface::class => EloquentFaqRepository::class,
        StatRepositoryInterface::class => EloquentStatRepository::class,
    ];

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
