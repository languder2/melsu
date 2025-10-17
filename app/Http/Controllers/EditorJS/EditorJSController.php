<?php

namespace App\Http\Controllers\EditorJS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EditorJSController extends Controller
{
    public function fetchLinkMeta(Request $request)
    {
        $targetUrl = $request->input('url');

        if (!$targetUrl) {
            return response()->json(['success' => 0], 400);
        }

        try {
            $response = Http::get($targetUrl);

            if ($response->failed()) {
                throw new \Exception('Failed to fetch URL content.');
            }

            $html = $response->body();

            $metaData = $this->parseHtmlForMeta($html);

            return response()->json([
                'success' => 1,
                'meta' => [
                    'title' => $metaData['title'] ?? 'Ссылка без заголовка',
                    'description' => $metaData['description'] ?? '',
                    'image' => [
                        'url' => $metaData['image'] ?? null,
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => 0], 404);
        }
    }

    private function parseHtmlForMeta(string $html): array
    {
        $title = preg_match('/<title>(.*?)<\/title>/is', $html, $matches) ? $matches[1] : null;
        $description = preg_match('/<meta[^>]*name="description"[^>]*content="([^"]*)"/i', $html, $matches) ? $matches[1] : null;
        $ogImage = preg_match('/<meta[^>]*property="og:image"[^>]*content="([^"]*)"/i', $html, $matches) ? $matches[1] : null;

        return [
            'title' => $title,
            'description' => $description,
            'image' => $ogImage,
        ];
    }
}
