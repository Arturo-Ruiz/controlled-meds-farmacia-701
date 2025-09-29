import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',

                'resources/css/components/sidebar.css',
                'resources/css/components/animations.css',
                'resources/css/auth/login.css',
                
                'resources/js/components/sidebar.js',
                'resources/js/components/header.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
