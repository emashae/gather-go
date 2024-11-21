<?php

namespace App\Providers;

use App\Models\Event;
use App\Policies\EventPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Event::class => EventPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
