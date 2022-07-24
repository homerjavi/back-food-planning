<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Account'  => 'App\Policies\AccountPolicy',
        'App\Models\Category' => 'App\Policies\CategoryPolicy',
        'App\Models\MealHour' => 'App\Policies\MealHourPolicy',
        'App\Models\Meal'     => 'App\Policies\MealPolicy',
        'App\Models\MealType' => 'App\Policies\MealTypePolicy',
        'App\Models\Planning' => 'App\Policies\PlanningPolicy',
        'App\Models\User'     => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
