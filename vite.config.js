import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/bundle.js'  // Bundled entry
            ],
            refresh: true,
        }),
    ],
    server: {
        fs: {
            allow: ['public', 'resources'], // Add resources directory
        },
    },
});
