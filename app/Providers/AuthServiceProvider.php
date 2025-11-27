<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Survey;
use App\Policies\SurveyPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Survey::class => SurveyPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
