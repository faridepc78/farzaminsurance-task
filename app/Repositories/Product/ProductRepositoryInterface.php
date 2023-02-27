<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\Contracts\BaseRepositoryInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function save_properties(Product $product, array $data);
}
