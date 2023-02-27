<?php

namespace App\Http\Resources\Api\V1\Admin\Product;

use App\Http\Resources\Api\V1\Admin\Property\PropertyResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'code' => $this->code,
            'price' => $this->price,
            'discount' => $this->discount,
            'final_price' => $this->final_price,
            'description' => $this->description,
            'image' => [
                'id' => $this->image->id,
                'path' => $this->image->original
            ],
            'properties' => PropertyResource::collection($this->properties),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
