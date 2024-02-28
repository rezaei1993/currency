<?php

namespace App\Services\V1;

use App\External\Repositories\V1\Contracts\CurrencyExchangeMysqlContract;
use App\Models\CurrencyAsset;
use App\Services\V1\Contracts\CurrencyAssetServiceContract;
use Illuminate\Database\Eloquent\Collection;

class CurrencyAssetService implements CurrencyAssetServiceContract
{

    public function __construct(private readonly CurrencyExchangeMysqlContract $currencyExchangeMysqlContract)
    {
    }

    /**
     * @param $data
     * @return CurrencyAsset
     */
    public function addAsset($data): CurrencyAsset
    {
        return $this->currencyExchangeMysqlContract->create($data);
    }

    /**
     * @return Collection
     */
    public function getAssets(): Collection
    {
        return $this->currencyExchangeMysqlContract->all();
    }

    /**
     * @return array
     */
    public function calculateAssets(): array
    {
        return $this->currencyExchangeMysqlContract->currencyAverages();
    }


}
