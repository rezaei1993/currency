<?php

namespace App\Providers;

use App\External\Repositories\V1\Contracts\CurrencyExchangeMysqlContract;
use App\External\Repositories\V1\Mysql\CurrencyExchangeMysql;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CurrencyExchangeMysqlContract::class, CurrencyExchangeMysql::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
