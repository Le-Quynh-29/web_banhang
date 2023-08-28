import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/tooltips.js',
                'resources/js/jquery-validation.js',
                'resources/js/navbar.js',
                'resources/js/tagify.js',
                'resources/sass/tagify.scss',
                'resources/js/modal-confirm.js',
                'resources/js/upload-preview.js',
                'resources/sass/upload-preview.scss',

                //User
                'resources/sass/user.scss',

                'resources/js/user/index.js',
                'resources/js/user/create.js',
                'resources/js/user/edit.js',
                //Category
                'resources/sass/category.scss',

                'resources/js/category/create.js',
                'resources/js/category/edit.js',
                //log
                'resources/js/log/log.js',
                'resources/js/log/show.js',

                //auth
                'resources/js/auth/login.js',

                //profile
                'resources/js/profile/edit.js',
                'resources/js/profile/change-password.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
            '~@coreui': path.resolve(__dirname, 'node_modules/@coreui'),
            '~@resources': path.resolve(__dirname, 'resources/'),
            '~block-ui': path.resolve(__dirname, 'node_modules/block-ui'),
            '~js-url': path.resolve(__dirname, 'node_modules/js-url'),
            '~jquery-validation': path.resolve(__dirname, 'node_modules/jquery-validation'),
            '~toastr': path.resolve(__dirname, 'node_modules/toastr'),
            '~tagify': path.resolve(__dirname, 'node_modules/@yaireo/tagify'),
        }
    },
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: [
                    {
                        loader: 'file-loader',
                        options: {
                            name: 'dist/css/[name].css',
                        }
                    },
                    {
                        loader: 'sass-loader'
                    }
                ]
            }
        ]
    },
    build: {
        chunkSizeWarningLimit: 1600,
    },
});
