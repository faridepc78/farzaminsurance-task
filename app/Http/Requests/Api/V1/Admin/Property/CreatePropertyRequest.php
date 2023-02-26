<?php

namespace App\Http\Requests\Api\V1\Admin\Property;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class CreatePropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() == true &&
            auth()->user()->role->value == UserRoleEnum::ADMIN->value;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150', 'unique:properties,name'],
            'value' => ['required', 'string', 'max:150', 'unique:properties,value']
        ];
    }
}
