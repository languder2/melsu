<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Gallery\Image;
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

            $path = Image::saveUploadFile($request->file('image'));

            return response()->json([
                'success' => 1,
                'file' => [
                    'url' => $path,
                ]
            ]);
        }

        return response()->json([
            'success' => 0,
            'message' => 'File upload failed.'
        ], 400);
    }
}
