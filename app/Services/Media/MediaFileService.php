<?php


namespace App\Services\Media;


use App\Models\Media;
use Illuminate\Http\UploadedFile;

class MediaFileService
{
    private static $file;
    private static $dir;
    private static $main_folder;
    private static $vip_folder;
    private static $isStorage;
    private static $isPrivate;

    public static function normalUpload(UploadedFile $file, string $main_folder,
                                        string       $vip_folder = null)
    {
        self::$file = $file;
        self::$dir = Media::UPLOADS . '/';
        self::$main_folder = $main_folder;
        self::$vip_folder = $vip_folder;
        self::$isStorage = false;
        self::$isPrivate = false;
        return self::upload();
    }

    public static function publicUpload(UploadedFile $file, string $main_folder,
                                        string       $vip_folder = null)
    {
        self::$file = $file;
        self::$dir = Media::PUBLIC . '/';
        self::$main_folder = $main_folder;
        self::$vip_folder = $vip_folder;
        self::$isStorage = true;
        self::$isPrivate = false;
        return self::upload();
    }

    public static function privateUpload(UploadedFile $file, string $main_folder,
                                         string       $vip_folder = null)
    {
        self::$file = $file;
        self::$dir = Media::PRIVATE . '/';
        self::$main_folder = $main_folder;
        self::$vip_folder = $vip_folder;
        self::$isStorage = true;
        self::$isPrivate = true;
        return self::upload();
    }

    private static function upload()
    {
        $extension = self::normalizeExtension(self::$file);
        foreach (config('mediaFile.MediaTypeServices') as $type => $service) {
            if (in_array($extension, $service['extensions'])) {
                return self::uploadByHandler(new $service['handler'], $type);
            }
        }
    }

    public static function delete(Media $media)
    {
        foreach (config('mediaFile.MediaTypeServices') as $type => $service) {
            if ($media->type == $type) {
                return $service['handler']::delete($media);
            }
        }
    }

    private static function normalizeExtension($file): string
    {
        return strtolower($file->getClientOriginalExtension());
    }

    private static function filenameGenerator($key): ?string
    {
        $format = null;

        switch ($key) {
            case Media::IMAGE:
                $format = make_token(50);
                break;
        }

        return $format;
    }

    private static function uploadByHandler(FileServiceContract $service, $key): Media
    {
        $media = new Media();
        $media->files = $service::upload(self::$file, self::filenameGenerator($key), self::$dir,
            self::$main_folder, self::$vip_folder, self::$isStorage);
        $media->type = $key;
        $media->filename = self::$file->getClientOriginalName();
        $media->base = explode('/', self::$dir)[0];
        $media->main_folder = self::$main_folder;
        $media->vip_folder = self::$vip_folder;
        $media->is_storage = self::$isStorage;
        $media->is_private = self::$isPrivate;
        $media->save();
        return $media;
    }

    public static function original(Media $media)
    {
        foreach (config('mediaFile.MediaTypeServices') as $type => $service) {
            if ($media->type == $type) {
                return $service['handler']::original($media);
            }
        }
    }
}
