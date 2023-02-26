<?php

namespace App\Http\Requests\Api\V1\Admin\Product;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() == true &&
            auth()->user()->role->value == UserRoleEnum::ADMIN->value;
    }

    public function rules(): array
    {
        return [

        ];
    }
}
