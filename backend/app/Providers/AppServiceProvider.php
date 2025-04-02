<?php

namespace App\Providers;

use App\Repository\BaseQueryRepository;
use App\Repository\Interface\BaseQueryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BaseQueryInterface::class,BaseQueryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
