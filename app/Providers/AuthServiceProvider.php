<?php

namespace App\Providers;

use App\models\Message;
use App\Models\User;
use App\Policies\GenericEntityPolicy;
use App\Policies\MessagePolicy;
use App\Policies\UserPolicy;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Message::class => MessagePolicy::class,
        User::class=>UserPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        foreach (get_class_methods(GenericEntityPolicy::class) as $method) {
            $gate->define($method,GenericEntityPolicy::class."@{$method}");
       }
        $this->registerPolicies($gate);

        //
    }
}
