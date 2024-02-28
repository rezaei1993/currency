<?php


use App\Models\CurrencyAsset;
use Tests\TestCase;

class CurrencyAssetTest extends TestCase
{
    public function testAddCurrencyAssetSuccess()
    {
        $data = [
            'currency' => 'USD',
            'amount' => 100,
            'exchange_rate' => 10
        ];

        $response = $this->postJson(route('currency.assets.add', $data));

        $response->assertStatus(201);

        $this->assertCount(1, CurrencyAsset::all());

        $response->assertJsonStructure([
            'status', 'message', 'data' => ['currency', 'amount', 'converted_value']
        ]);
    }

    /**
     * @dataProvider failedValidationForAdd
     */
    public function testAddCurrencyAssetValidationError(array $data, string $errorKey, string $errorMessage)
    {
        $response = $this->postJson(route('currency.assets.add', $data));

        $response->assertJsonStructure([
            'message',
            'errors' => [
                $errorKey,
            ],
        ]);

        $response->assertJson([
            'message' => $errorMessage,
            'errors' => [
                $errorKey => [
                    $errorMessage,
                ],
            ],
        ]);
    }

    public function testListCurrencyAssetsSuccess()
    {
        CurrencyAsset::factory()->count(3)->make();

        $response = $this->getJson(route('currency.assets.list'));

        $response->assertOk();

        $response->assertJsonStructure([
            'status', 'message', 'data' => [
                '*' => ['id', 'currency', 'amount', 'converted_value']
            ]
        ]);
    }

    public function testCalculateTotalCurrencyAssetValue()
    {
        CurrencyAsset::factory()->create([
            'currency' => 'USD',
            'amount' => 1000,
            'exchange_rate' => 500.000
        ]);

        CurrencyAsset::factory()->create([
            'currency' => 'USD',
            'amount' => 600,
            'exchange_rate' => 550.000
        ]);

        $response = $this->getJson(route('currency.assets.calculate'));

        $response->assertOk();

        $response->assertJsonStructure([
            'status', 'data'
        ]);

        $this->assertSame($response->json()['data'], [
            "USD" => [
                "total_amount" => 1600,
                "average_rate" => 518.75
            ]
        ]);
    }

    public static function failedValidationForAdd(): array
    {
        return [
            [
                'data' => [
                    'currency' => 'x',
                    'amount' => 100,
                    'exchange_rate' => 100,
                ],
                'error_key' => 'currency',
                'error_message' => 'The selected currency is invalid.',
            ],
            [
                'data' => [
                    'currency' => 'USD',
                    'exchange_rate' => 100,
                ],
                'error_key' => 'amount',
                'error_message' => 'The amount field is required.',
            ],
            [
                'data' => [
                    'currency' => 'USD',
                    'exchange_rate' => 100,
                ],
                'error_key' => 'amount',
                'error_message' => 'The amount field is required.',
            ],
            [
                'data' => [
                    'amount' => 100,
                    'exchange_rate' => 100,
                ],
                'error_key' => 'currency',
                'error_message' => 'The currency field is required.',
            ],
        ];
    }
}
