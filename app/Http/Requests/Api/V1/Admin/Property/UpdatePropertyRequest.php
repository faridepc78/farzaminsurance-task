<?php

namespace App\Http\Requests\Api\V1\Admin\Property;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() == true &&
            auth()->user()->role->value == UserRoleEnum::ADMIN->value;
    }

    public function rules(): array
    {
        $id = request()->property->id;

        return [
            'name' => ['nullable', 'string', 'max:150', 'unique:properties,name,' . $id],
            'value' => ['nullable', 'string', 'max:150', 'unique:properties,value,' . $id]
        ];
    }
}
