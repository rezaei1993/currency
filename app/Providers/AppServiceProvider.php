<?php

namespace App\Providers;

use App\External\Repositories\V1\Contracts\CurrencyExchangeMysqlContract;
use App\External\Repositories\V1\Mysql\CurrencyExchangeMysql;
use App\Services\V1\Contracts\CurrencyAssetServiceContract;
use App\Services\V1\CurrencyAssetService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CurrencyExchangeMysqlContract::class, CurrencyExchangeMysql::class);
        $this->app->bind(CurrencyAssetServiceContract::class, CurrencyAssetService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
