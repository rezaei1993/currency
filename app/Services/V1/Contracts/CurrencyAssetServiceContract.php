<?php

namespace App\Services\V1\Contracts;


use App\Models\CurrencyAsset;
use Illuminate\Database\Eloquent\Collection;


interface CurrencyAssetServiceContract
{
    public function addAsset($data): CurrencyAsset;

    public function getAssets(): Collection;

    public function calculateAssets(): array;

}
