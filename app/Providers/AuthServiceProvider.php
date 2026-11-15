<?php

/**
 * AuthServiceProvider
 *
 * Registers Eloquent model authorization policies for the Portfolio CMS.
 */

declare(strict_types=1);

namespace App\Providers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Credential;
use App\Models\Experience;
use App\Models\Faq;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Stat;
use App\Models\Technology;
use App\Models\Testimonial;
use App\Policies\BlogPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\ContactMessagePolicy;
use App\Policies\CredentialPolicy;
use App\Policies\ExperiencePolicy;
use App\Policies\FaqPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\ServicePolicy;
use App\Policies\SettingPolicy;
use App\Policies\StatPolicy;
use App\Policies\TechnologyPolicy;
use App\Policies\TestimonialPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Project::class => ProjectPolicy::class,
        Technology::class => TechnologyPolicy::class,
        Experience::class => ExperiencePolicy::class,
        Credential::class => CredentialPolicy::class,
        Service::class => ServicePolicy::class,
        Testimonial::class => TestimonialPolicy::class,
        Category::class => CategoryPolicy::class,
        Blog::class => BlogPolicy::class,
        ContactMessage::class => ContactMessagePolicy::class,
        Faq::class => FaqPolicy::class,
        Stat::class => StatPolicy::class,
        Setting::class => SettingPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
