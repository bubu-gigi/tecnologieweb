import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: [
                // Rimuoviamo refresh automatico da storage/
                'resources/views/**/*.blade.php',
                'resources/js/**/*.js',
                'resources/css/**/*.css',
                'routes/**/*.php',
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: [
                '**/storage/**',
                '**/vendor/**',
            ],
        },
    },
});
