<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\Contracts\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public Model $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function save_properties(Product $product, array $data): array
    {
        return $product->properties()->sync($data);
    }
}
