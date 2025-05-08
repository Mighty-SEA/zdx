import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/admin.css',
                'resources/js/admin.js',
                'resources/css/landing.css',
                'resources/js/landing.js',
                'resources/css/home.css',
                'resources/js/home.js',
                'resources/css/tracking.css',
                'resources/js/tracking.js',
                'resources/css/services.css',
                'resources/js/services.js',
                'resources/css/rates.css',
                'resources/js/rates.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
