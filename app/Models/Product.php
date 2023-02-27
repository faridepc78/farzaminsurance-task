<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    protected $appends =
        [
            'final_price'
        ];

    public function image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'image_id')->withDefault();
    }

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'product_properties');
    }

    public function getFinalPriceAttribute()
    {
        if ($this->discount != null)
            return round($this->price - ($this->price * ($this->discount / 100)));

        return $this->price;
    }
}
