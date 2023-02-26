<?php

namespace App\Repositories\Property;

use App\Models\Property;
use App\Repositories\Contracts\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class PropertyRepository extends BaseRepository implements PropertyRepositoryInterface
{
    public Model $model;

    public function __construct(Property $model)
    {
        $this->model = $model;
    }
}
