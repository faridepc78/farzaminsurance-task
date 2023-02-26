<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $guarded =
        [
            'id',
            'created_at',
            'updated_at'
        ];

    protected $fillable =
        [
            'name',
            'slug',
            'code',
            'image_id',
            'price',
            'discount',
            'description'
        ];

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_id')->withDefault();
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class, 'property_id');
    }
}
