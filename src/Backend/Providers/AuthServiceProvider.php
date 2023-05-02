<?php

namespace Dply\Backend\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Dply\Backend\Models\Post;
use Dply\Backend\Models\Taxonomy;
use Dply\CMS\Models\User;
use Dply\Backend\Policies\PostPolicy;
use Dply\Backend\Policies\TaxonomyPolicy;
use Dply\Backend\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Taxonomy::class => TaxonomyPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(
            function ($user, $ability) {
                if ($user->isAdmin()) {
                    return true;
                }

                return null;
            }
        );

        ResetPassword::createUrlUsing(
            function ($notifiable, $token) {
                return config('app.frontend_url')
                    . "/password-reset/{$token}?email={$notifiable->getEmailForPasswordReset()}";
            }
        );
    }
}
