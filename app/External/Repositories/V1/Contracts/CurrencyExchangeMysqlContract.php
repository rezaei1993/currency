<?php

namespace App\External\Repositories\V1\Contracts;

use App\Models\CurrencyAsset;
use Illuminate\Database\Eloquent\Collection;

interface CurrencyExchangeMysqlContract
{
    public function all(): Collection;

    public function create($data): CurrencyAsset;

     public function currencyAverages(): array;
}
