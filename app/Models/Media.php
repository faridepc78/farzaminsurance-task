<?php

namespace App\Models;

use App\Services\Media\MediaFileService;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    protected $guarded =
        [
            'id',
            'created_at',
            'updated_at'
        ];

    protected $fillable =
        [
            'files',
            'type',
            'filename',
            'base',
            'main_folder',
            'vip_folder',
            'is_storage',
            'is_private'
        ];

    const IMAGE = 'image';
    const VIDEO = 'video';

    static array $types =
        [
            self::IMAGE,
            self::VIDEO
        ];

    const UPLOADS = 'uploads';
    const PUBLIC = 'public';
    const PRIVATE = 'private';

    static array $bases =
        [
            self::UPLOADS,
            self::PUBLIC,
            self::PRIVATE
        ];

    protected $casts =
        [
            'files' => 'json'
        ];

    protected static function booted()
    {
        static::deleting(function ($media) {
            MediaFileService::delete($media);
        });
    }

    public function getOriginalAttribute()
    {
        return MediaFileService::original($this);
    }
}
