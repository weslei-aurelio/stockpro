import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input:
            [
                'resources/scss/styles.scss',
                'resources/js/main.js'
            ],
            refresh: true,
        }),
    ],
});
