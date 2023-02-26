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
}
