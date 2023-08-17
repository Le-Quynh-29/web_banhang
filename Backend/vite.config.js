import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/admin.css',
                'resources/css/fontawesome.css',
                'resources/js/app.js',
                'resources/js/jquery-validation.js',
                'resources/js/admin-login.js',
                'resources/js/header.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~js-url': path.resolve(__dirname, 'node_modules/js-url'),
            '~jquery-validation': path.resolve(__dirname, 'node_modules/jquery-validation'),
            '~toastr': path.resolve(__dirname, 'node_modules/toastr'),
        }
    },
    build: {
        chunkSizeWarningLimit: 1600,
    },
});
