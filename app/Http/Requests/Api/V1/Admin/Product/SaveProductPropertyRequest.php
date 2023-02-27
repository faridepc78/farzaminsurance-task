<?php

namespace App\Http\Requests\Api\V1\Admin\Product;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class SaveProductPropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() == true &&
            auth()->user()->role->value == UserRoleEnum::ADMIN->value;
    }

    public function rules(): array
    {
        return [
            'data' => ['required', 'array', 'min:1'],
            'data.*' => ['size:1'],
            'data.*.property_id' => ['required', 'distinct', 'exists:properties,id']
        ];
    }
}
