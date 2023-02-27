<?php

namespace App\Http\Requests\Api\V1\Admin\Product;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() == true &&
            auth()->user()->role->value == UserRoleEnum::ADMIN->value;
    }

    public function rules(): array
    {
        $id = request()->product->id;

        return [
            'name' => ['nullable', 'string', 'max:150', 'unique:products,name,' . $id],
            'slug' => ['nullable', 'string', 'max:150', 'unique:products,slug,' . $id],
            'image' => ['nullable', 'mimes:jpg,png,jpeg', 'max:2048'],
            'price' => ['nullable', 'numeric', 'between:1000,1000000000'],
            'discount' => ['nullable', 'numeric', 'between:1,90'],
            'description' => ['nullable', 'string', 'max:1000000']
        ];
    }
}
