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
                'resources/js/login.js',
                'resources/js/navbar.js',
                //User
                'resources/sass/user.scss',

                'resources/js/users/user-index.js',
                'resources/js/users/user-create.js',
                'resources/js/users/user-edit.js',
                //Category
                'resources/sass/category.scss',
                
                'resources/js/categories/category-index.js',
                'resources/js/categories/category-create.js',
                'resources/js/categories/category-edit.js',
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
