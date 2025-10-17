<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaUploadController extends Controller
{
    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480', // 2MB max
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $path = $file->store('editorjs_images', 'public');

            $fullUrl = Storage::disk('public')->url($path);

            return response()->json([
                'success' => 1,
                'file' => [
                    'url' => $fullUrl,
                    // Можно добавить дополнительные данные, такие как 'title'
                ]
            ]);
        }

        return response()->json([
            'success' => 0,
            'message' => 'File upload failed.'
        ], 400);
    }


    public function uploadVideo(Request $request): JsonResponse
    {
        $request->validate([
            'video' => 'required|file|mimes:mp4,webm,ogg|max:50000', // Макс. 50MB
        ]);

        if ($request->hasFile('video')) {
            $file = $request->file('video');

            $path = $file->store('editorjs_videos', 'public');

            $fullUrl = Storage::disk('public')->url($path);

            return response()->json([
                'success' => 1,
                'file' => [
                    'url' => $fullUrl,
                    'path' => $path,
                ]
            ]);
        }

        return response()->json([
            'success' => 0,
            'message' => 'Video upload failed.'
        ], 400);
    }
}
