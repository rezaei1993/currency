<?php

namespace App\Models;

use Database\Factories\CurrencyAssetFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $currency
 * @property float $amount
 * @property float $exchange_rate
 * @property float $converted_value
 */
class CurrencyAsset extends Model
{
    use HasFactory;

    protected $fillable = ['currency', 'amount', 'exchange_rate'];
    protected $casts = [
        'amount' => 'float',
        'exchange_rate' => 'float'
    ];

    public function getConvertedValueAttribute(): float|int
    {
        return $this->amount * $this->exchange_rate;
    }

    protected static function newFactory(): CurrencyAssetFactory
    {
        return CurrencyAssetFactory::new();
    }
}
