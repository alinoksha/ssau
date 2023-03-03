<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\Product;

class BrandService
{
    public function getBrandsWithProducts(int $page, int $perPage, string $sort = null): array
    {
        $query = Brand::with('products')
            ->withAvg('products', 'price')
            ->forPage($page, $perPage);

        if ($sort !== null) {
            $query->orderBy('products_avg_price', $sort);
        }

        $brands = $query->get();

        return [
            'items' => $brands->map(function (Brand $brand) {
                return [
                    'id' => $brand->id,
                    'name' => $brand->name,
                    'productNames' => $brand->products->pluck('name')->toArray(),
                    'averagePrice' => $brand->products->average(function (Product $product) {
                        return $product->price;
                    }),
                ];
            })->toArray(),
            'total' => Brand::query()->count(),
            'page' => $page,
            'per_page' => $perPage,
        ];
    }
}