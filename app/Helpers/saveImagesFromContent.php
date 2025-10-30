<?php

use App\Models\Gallery\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

if (!function_exists('saveImagesFromContent')) {
    function saveImagesFromContent($content): ?string
    {
        ini_set('pcre.backtrack_limit', 100000000);

        if (preg_match_all('/src="data:image\/(?<mime>.*?);base64,(?<data>.*?)"/', $content, $matches)) {

            $mimes = $matches['mime'];

            foreach ($mimes as $key => $mime) {
                $base64Data = $matches['data'][$key];

                $imageData = base64_decode($base64Data);

                $image = tempnam(sys_get_temp_dir(), 'uploaded_file');

                File::put($image, $imageData);

                $uploadedFile = new UploadedFile(
                    $image,
                    Str::random(20),
                    $mime,
                    filesize($image),
                    0,
                    true
                );

                $path = Image::saveUploadFile($uploadedFile);

                $content = str_replace("data:image/$mime;base64,$base64Data", $path, $content);
            }
        }

        return $content;
    }
}
