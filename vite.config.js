import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        outDir: 'public_html/build',
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/info.css',
                'resources/css/admin.css',
                'resources/css/cabinet.css',
                'resources/js/app.js',
                'resources/js/cabinet.js',
                'resources/js/info.js',
                'resources/js/admin.js',
                'resources/js/editorjs/editor.js',
                'resources/js/editorjs/slider.js',
                'resources/js/styled-select-with-search.js',
            ],
            publicDirectory: 'public_html',
            refresh: true,
        }),
    ],
    server: {
        cors: true, // Разрешает CORS для всех
        // Или более строгий вариант:
        // cors: {
        //     origin: 'https://melsu.local'
        // },
        hmr: {
            host: '127.0.0.1',
        },
    },
});
