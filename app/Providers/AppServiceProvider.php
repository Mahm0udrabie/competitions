<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\UserRepositoryInterface','App\Repositories\UserRepository');
        $this->app->bind('App\Repositories\CompetitionsRepositoryInterface','App\Repositories\CompetitionsRepository');
        $this->app->bind('App\Repositories\ClubsRepositoryInterface','App\Repositories\ClubsRepository');
        $this->app->bind('App\Repositories\ConfigurationRepositoryInterface','App\Repositories\ConfigurationRepository');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
