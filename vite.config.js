import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input:
            [
                'resources/scss/styles.scss',
                'resources/scss/login.scss',
                'resources/scss/register.scss',
                'resources/scss/forgot_password.scss',
                'resources/scss/themes.scss',
                'resources/scss/index.scss',
                'resources/scss/header.scss',
                'resources/js/main.js'
            ],
            refresh: true,
        }),
    ],
});
