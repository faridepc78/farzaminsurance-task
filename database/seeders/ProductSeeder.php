<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $productRepository = resolve(ProductRepositoryInterface::class);

        if (!$productRepository->getCount()) {
            Product::factory(10)->create();
        } else {
            $this->command->warn('Products has already been created');
        }
    }
}
