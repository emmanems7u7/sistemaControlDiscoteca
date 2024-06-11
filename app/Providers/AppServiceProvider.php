<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\NotificationInterface;
use App\Repositories\NotificationRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       

        $this->app->bind(NotificationInterface::class, NotificationRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
