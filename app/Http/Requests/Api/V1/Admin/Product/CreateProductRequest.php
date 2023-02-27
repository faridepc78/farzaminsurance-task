<?php

namespace App\Http\Requests\Api\V1\Admin\Product;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() == true &&
            auth()->user()->role->value == UserRoleEnum::ADMIN->value;
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'code' => make_token(10),
            'slug' => Str::slug(request()->input('slug'))
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150', 'unique:products,name'],
            'slug' => ['required', 'string', 'max:150', 'unique:products,slug'],
            'image' => ['required', 'mimes:jpg,png,jpeg', 'max:2048'],
            'price' => ['required', 'numeric', 'between:1000,1000000000'],
            'discount' => ['nullable', 'numeric', 'between:1,90'],
            'description' => ['required', 'string', 'max:1000000']
        ];
    }
}
