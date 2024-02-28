<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CreateCurrencyExchangeRequest;
use App\Http\Resources\V1\CurrencyAssetResource;
use App\Services\V1\Contracts\CurrencyAssetServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CurrencyAssetController extends Controller
{
    public function __construct(private readonly CurrencyAssetServiceContract $currencyServiceContract)
    {
    }

    /**
     * @return JsonResponse
     */
    public function list()
    {
        $items = $this->currencyServiceContract->getAssets();

        return response()->json([
            'status' => Lang::get('messages.success'),
            'message' => Lang::get('messages.items_retrieved_successfully'),
            'data' => CurrencyAssetResource::collection($items)
        ], ResponseAlias::HTTP_OK);
    }


    /**
     * @param CreateCurrencyExchangeRequest $request
     * @return JsonResponse
     */
    public function add(CreateCurrencyExchangeRequest $request)
    {
        try {
            $currencyAsset = $this->currencyServiceContract->addAsset($request->validated());

            return response()->json([
                'status' => Lang::get('messages.success'),
                'message' => Lang::get('messages.created_success'),
                'data' => CurrencyAssetResource::make($currencyAsset)
            ], ResponseAlias::HTTP_CREATED);

        } catch (\Exception $exception) {
            return response()->json([
                'status' => Lang::get('messages.fail'),
                'message' => Lang::get('messages.internal_error'),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @return JsonResponse
     */
    public function calculate()
    {
        $data = $this->currencyServiceContract->calculateAssets();

        return response()->json([
            'status' => Lang::get('messages.success'),
            'data' => $data
        ], ResponseAlias::HTTP_OK);
    }
}
