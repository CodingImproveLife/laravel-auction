<?php

namespace App\Providers;

use App\Models\Lot;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('show-lot', function (User $user, Lot $lot) {
            return $user->id === $lot->user_id ||
                $lot->status !== 'Draft' ||
                $user->hasPermissionTo('edit lots');
        });

        Gate::define('edit-lot', function (User $user, Lot $lot) {
            return $user->id === $lot->user_id || $user->hasPermissionTo('edit lots');
        });

        Gate::define('store-bid', function (User $user, Lot $lot) {
            $notOwnLot = $user->id !== $lot->user_id;
            $saleTimeNotExpired = Carbon::now()->lessThanOrEqualTo($lot->end_time);
            $lotOnSale = $lot->status === 'On sale';

            return $notOwnLot && $saleTimeNotExpired && $lotOnSale;
        });
    }
}
