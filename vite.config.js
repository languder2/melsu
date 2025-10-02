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
                'resources/js/app.js',
                'resources/css/cabinet.css',
                'resources/js/cabinet.js',
                'resources/css/info.css',
                'resources/js/info.js',
                'resources/css/admin.css',
                'resources/js/admin.js',
            ],
            publicDirectory: 'public_html',
            refresh: true,
        }),
        '@tailwindcss/typography',
    ],
});
