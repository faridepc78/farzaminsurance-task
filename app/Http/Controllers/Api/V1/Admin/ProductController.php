<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\Product\CreateProductRequest;
use App\Http\Requests\Api\V1\Admin\Product\UpdateProductRequest;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;

class ProductController extends Controller
{
    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        //
    }

    public function store(CreateProductRequest $request)
    {
        //
    }

    public function show(Product $product)
    {
        //
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
