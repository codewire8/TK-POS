<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Session\CartRepository;
use App\Repositories\Contracts\CartRepositoryContract;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        CartRepositoryContract::class => CartRepository::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
