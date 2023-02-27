<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\Product\CreateProductRequest;
use App\Http\Requests\Api\V1\Admin\Product\SaveProductPropertyRequest;
use App\Http\Requests\Api\V1\Admin\Product\UpdateProductRequest;
use App\Http\Resources\Api\V1\Admin\Product\ProductPaginateResource;
use App\Http\Resources\Api\V1\Admin\Product\ProductResource;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\Media\MediaFileService;

class ProductController extends Controller
{
    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->paginate(10);

        return new ProductPaginateResource($products);
    }

    public function store(CreateProductRequest $request)
    {
        $this->updateImage($request);

        $product = $this->productRepository->create(my_filter($request->validationData()));

        return $this->success_response(new ProductResource($product),
            'product has been successfully created');
    }

    public function show(Product $product)
    {
        return $this->success_response(new ProductResource($product),
            'product information');
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->updateImage($request, $product);

        $this->productRepository->update(my_filter($request->validationData()),
            $product->id);

        return $this->success_response(new ProductResource($product->refresh()),
            'product has been successfully updated');
    }

    public function destroy(Product $product)
    {
        $product->image?->delete();

        $this->productRepository->delete($product->id);

        return $this->success_response(null,
            'product has been successfully deleted');
    }

    public function save_properties(Product $product, SaveProductPropertyRequest $request)
    {
        $this->productRepository->save_properties($product,
            $request->input('data'));

        return $this->success_response(new ProductResource($product),
            'product properties has been successfully saved');
    }

    protected function updateImage($request, $product = null)
    {
        if ($request->hasFile('image')) {

            $image_id = MediaFileService::
            normalUpload($request->file('image'),
                'products/images', null)->id;

            $request->merge([
                'image_id' => $image_id
            ]);

            $product?->image?->delete();
        }
    }
}
