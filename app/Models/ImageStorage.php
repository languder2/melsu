<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManager;

class ImageStorage extends Model
{
    public static $FormRules = [
        'image'             => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048"
    ];
    public static $FormMessage = [
        'image.image'       => 'В изображении должен быть выбрать файл-картинка с расширениями jpeg,png,jpg,gif',
        'image.mimes'       => 'Изображении должен быть выбрать файл-картинка с расширениями jpeg,png,jpg,gif',
        'max'               => 'Максимальный размер загружаемого изображения ограничен 2MB',
    ];
    public static function saveImage($image, $path, $width, $height):void
    {

        $image->coverDown($width, $height,'center')
            ->toJpeg(90)
            ->save($path);
    }
    public static function saveResizedImageToStorage(string $to,string $file, string $name,array $resolves=[]):bool
    {

        if(!file_exists($file)) return false;

        $image = ImageManager::imagick()->read($file);

        foreach ($resolves as $resolve){


            if(!is_array($resolve))
                $resolve = explode(":",$resolve);

            $path = storage_path('app/public/images')."/{$to}/{$resolve[0]}x{$resolve[1]}_{$name}.jpg";

            self::saveImage($image,$path,$resolve[0],$resolve[1]);
        }
        return true;

    }
}
