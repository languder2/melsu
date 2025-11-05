<?php
if (!function_exists('rawTextToEditorJS')) {
    /**
     * @param string|array|\Illuminate\Support\Collection|null $text
     * @return string
     */
    function rawTextToEditorJS($data = null ): string
    {
        $data = collect($data);

        $result = (object)['blocks' => []];

        $data->each(
            fn($item) => $result->blocks[] =(object)[
                'type' => 'code',
                'data' => (object)[
                    'code' => $item,
                ]
            ]
        );

        return json_encode($result, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_NUMERIC_CHECK );
    }
}
