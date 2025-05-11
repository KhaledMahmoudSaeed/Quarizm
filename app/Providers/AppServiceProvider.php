<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\CoachDate;
use App\Models\PrivateSession;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Workshop;
use App\Policies\CategoryPolicy;
use App\Policies\CoachDatePolicy;
use App\Policies\PrivateSessionPolicy;
use App\Policies\ReservationPolicy;
use App\Policies\UserPolicy;
use App\Policies\WorkshopPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local') && class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // to prevent SQL Error if user try to miss with url and go to edit or show without provide ID 
        $bindings = [
            'category' => Category::class,
            'coachdata' => CoachDate::class,
            'privatesession' => PrivateSession::class,
            'workshop' => Workshop::class,
            'reservation' => Reservation::class,
        ];

        foreach ($bindings as $param => $modelClass) {
            Route::bind($param, function ($value) use ($modelClass) {
                if (!ctype_digit($value)) {
                    abort(404);
                }
                return $modelClass::findOrFail($value);
            });
        }
        Model::preventLazyLoading(!$this->app->environment('production'));
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Category::class, CategoryPolicy::class);
        Gate::policy(CoachDate::class, CoachDatePolicy::class);
        Gate::policy(PrivateSession::class, PrivateSessionPolicy::class);
        Gate::policy(Reservation::class, ReservationPolicy::class);
        Gate::policy(Workshop::class, WorkshopPolicy::class);
    }
}
