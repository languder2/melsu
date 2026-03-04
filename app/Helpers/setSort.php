<?php
if (!function_exists('setSort')) {
    /**
     * Транслитерация строки с кириллицы на латиницу.
     *
     * @param string $text
     * @return string
     */
    function setSort(\Illuminate\Support\Collection $collect, string $filed = 'sort'): void
    {
        $collect->each(fn($item, $index) => $item->fill([$filed => ($index + 1) * 100])->save());

    }
}
