<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class MediaUploadController extends Controller
{
    public function upload(Request $request): JsonResponse
    {
        $maxWidth = 1920;
        $maxHeight = 1080;

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:20480', // 2MB max
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $manager = new ImageManager(new Driver());

            $image = $manager->read($file)
                ->scale($maxWidth, $maxHeight)
                ->toWebp(90)
            ;

            $fileName = Str::random(20);

            $path = 'images/'.date('Y').'/'.date('m').'/'.date('d').'/'.date('H_i_s').'_'.$fileName.'.webp';

            Storage::put($path, $image);

            $fullUrl = Storage::disk('public')->url($path);

            return response()->json([
                'success' => 1,
                'file' => [
                    'url' => $fullUrl,
                ]
            ]);
        }

        return response()->json([
            'success' => 0,
            'message' => 'File upload failed.'
        ], 400);
    }
}
