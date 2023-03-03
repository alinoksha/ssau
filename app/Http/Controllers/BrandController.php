<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetBrandsWithProductsRequest;
use App\Services\BrandService;
use Illuminate\Http\JsonResponse;

class BrandController extends Controller
{
    private const DEFAULT_PER_PAGE = 25;

    private BrandService $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function list(GetBrandsWithProductsRequest $request): JsonResponse
    {
        $data = $request->validated();

        $result = $this->brandService->getBrandsWithProducts(
            $data['page'] ?? 1,
            $data['per_page'] ?? self::DEFAULT_PER_PAGE,
            $data['sort'] ?? null
        );

        return new JsonResponse($result);
    }
}