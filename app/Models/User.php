<?php

namespace App\Models;

use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'users';

    protected $guarded =
        [
            'id',
            'created_at',
            'updated_at'
        ];

    protected $fillable =
        [
            'name',
            'email',
            'password',
            'role'
        ];
    protected $hidden =
        [
            'password'
        ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    protected $casts =
        [
            'role' => UserRoleEnum::class
        ];

    static array $admin =
        [
            'name' => 'mahan',
            'email' => 'mahan@gmail.com',
            'password' => 123456,
            'role' => UserRoleEnum::ADMIN->value
        ];
}
