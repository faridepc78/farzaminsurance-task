<?php


namespace App\Services\Media;


use App\Models\Media;
use Illuminate\Http\UploadedFile;

interface FileServiceContract
{
    public static function upload(UploadedFile $file, string $filename, string $dir,
                                  string       $main_folder, string $vip_folder,
                                  bool         $isStorage);

    public static function delete(Media $media);
}
