<?php

namespace App\Http\Resources\V1;

use App\Models\CurrencyAsset;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin CurrencyAsset */
class CurrencyAssetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'currency' => $this->currency,
            'amount' => $this->amount,
            'exchange_rate' => $this->exchange_rate,
            'converted_value' => $this->converted_value,
        ];
    }
}
