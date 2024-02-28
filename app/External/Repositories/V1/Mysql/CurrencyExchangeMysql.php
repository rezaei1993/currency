<?php

namespace App\External\Repositories\V1\Mysql;

use App\External\Repositories\V1\Contracts\CurrencyExchangeMysqlContract;
use App\Models\CurrencyAsset;
use Illuminate\Database\Eloquent\Collection;

class CurrencyExchangeMysql implements CurrencyExchangeMysqlContract
{
    public function all(): Collection
    {
        return CurrencyAsset::all();
    }

    public function create($data): CurrencyAsset
    {
        return CurrencyAsset::create([
            'currency' => $data['currency'],
            'amount' => $data['amount'],
            'exchange_rate' => $data['exchange_rate'],
        ]);
    }


    public function currencyAverages(): array
    {
        return $this->all()
            ->groupBy('currency')
            ->map(function (Collection $assets) {
                return $this->calculateAverages($assets);
            })
            ->toArray();
    }

    private function calculateAverages(Collection $assets): array
    {
        $totalAmount = $assets->sum('amount');

        $totalValue = $assets->sum(function ($asset) {
            return $asset->amount * $asset->exchange_rate;
        });

        return [
            'total_amount' => $totalAmount,
            'average_rate' => $totalValue / $totalAmount
        ];
    }

}
