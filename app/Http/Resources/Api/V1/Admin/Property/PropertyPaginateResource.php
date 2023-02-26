<?php

namespace App\Http\Resources\Api\V1\Admin\Property;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PropertyPaginateResource extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'status' => 'Success',
            'message' => 'list of properties',
            'code' => 200,
            'data' => $this->collection->map(function ($item) {

                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'value' => $item->value,
                    'created_at' => $item->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $item->updated_at->format('Y-m-d H:i:s')
                ];
            })
        ];
    }
}
