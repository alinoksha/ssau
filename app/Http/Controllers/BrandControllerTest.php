<?php

namespace App\Http\Controllers;


use App\Models\Brand;
use Tests\TestCase;

class BrandControllerTest extends TestCase
{
    public function test()
    {
        $brands = Brand::with('products')->forPage(1, 100)->toSql();

    }
}
