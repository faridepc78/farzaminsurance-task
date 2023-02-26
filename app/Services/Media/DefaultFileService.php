<?php


namespace App\Services\Media;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

abstract class DefaultFileService
{
    public static $media;

    public static function delete($media)
    {
        foreach ($media->files as $file) {
            $key = $media->base;

            if ($media->is_storage) {
                if (empty($media->vip_folder)) {
                    Storage::delete($key . '\\' . $file);
                } else {
                    Storage::delete($key . '\\' . $file);
                    $full_path = $key . '/' . $media->main_folder . '/' . $media->vip_folder;
                    if (is_dir_empty($full_path)) {
                        rmdir($full_path);
                    }
                }
            } else {
                if (empty($media->vip_folder)) {
                    unlink($key . '/' . $file);
                } else {
                    unlink($key . '/' . $file);
                    $full_path = $key . '/' . $media->main_folder . '/' . $media->vip_folder;
                    if (is_dir_empty($full_path)) {
                        rmdir($full_path);
                    }
                }
            }
        }
    }

    public static function upload(UploadedFile $file, $filename, $dir,
                                               $main_folder, $vip_folder, $isStorage): array
    {
        return $isStorage
            ? self::storageUpload($file, $filename, $dir, $main_folder, $vip_folder)
            : self::normalUpload($file, $filename, $dir, $main_folder, $vip_folder);
    }

    private static function normalUpload(UploadedFile $file, $filename, $dir,
                                                      $main_folder, $vip_folder): array
    {
        $path = $main_folder . '/' . $vip_folder . '/';
        $full_path = $dir . $main_folder . '/' . $vip_folder . '/';
        $file->move(public_path($full_path), $filename . '.' . $file->getClientOriginalExtension());
        $original_path = $path . $filename . '.' . $file->getClientOriginalExtension();
        return self::originalUpload($original_path);
    }

    private static function storageUpload(UploadedFile $file, $filename, $dir,
                                                       $main_folder, $vip_folder): array
    {
        $path = $main_folder . '/' . $vip_folder . '/';
        $full_path = $dir . $main_folder . '/' . $vip_folder . '/';
        Storage::putFileAs($full_path, $file, $filename . '.' . $file->getClientOriginalExtension());
        $original_path = $path . $filename . '.' . $file->getClientOriginalExtension();
        return self::originalUpload($original_path);
    }

    private static function originalUpload($path): array
    {
        $img['original'] = $path;
        return $img;
    }

    public static function original(Media $media)
    {
        switch ($media->base) {
            case Media::UPLOADS:
                return '/' . Media::UPLOADS . '/' . $media->files['original'];
            case Media::PUBLIC:
                return 'storage/' . $media->files['original'];
            case Media::PRIVATE:
                return 'this file is private';
        }
    }
}
