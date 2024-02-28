<?php

namespace Database\Factories;

use App\Libraries\Enums\CurrencyEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CurrencyAsset>
 */
class CurrencyAssetFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'currency' => Arr::random(CurrencyEnum::cases()),
            'amount' => rand(1000, 10000),
            'exchange_rate' => rand(1000, 10000),
        ];
    }
}
