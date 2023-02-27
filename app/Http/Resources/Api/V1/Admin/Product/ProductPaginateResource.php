<?php

namespace App\Http\Resources\Api\V1\Admin\Product;

use App\Http\Resources\Api\V1\Admin\Property\PropertyResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductPaginateResource extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'status' => 'Success',
            'message' => 'list of products',
            'code' => 200,
            'data' => $this->collection->map(function ($item) {

                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'slug' => $item->slug,
                    'code' => $item->code,
                    'price' => $item->price,
                    'discount' => $item->discount,
                    'final_price' => $item->final_price,
                    'description' => $item->description,
                    'image' => [
                        'id' => $item->image->id,
                        'path' => $item->image->original
                    ],
                    'properties' => PropertyResource::collection($item->properties),
                    'created_at' => $item->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $item->updated_at->format('Y-m-d H:i:s')
                ];
            })
        ];
    }
}
