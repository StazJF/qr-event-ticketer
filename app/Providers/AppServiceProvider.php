<?php

namespace App\Providers;

use App\Repositories\AttendeeRepository;
use App\Repositories\Contracts\AttendeeRepositoryInterface;
use App\Repositories\Contracts\EventRepositoryInterface;
use App\Repositories\EventRepository;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(AttendeeRepositoryInterface::class, AttendeeRepository::class);
    }

    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request): Limit {
            return Limit::perMinute(60)->by($request->user()?->getKey() ?: $request->ip());
        });
    }
}
