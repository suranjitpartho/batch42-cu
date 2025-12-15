import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    // server: {
    //     host: '192.168.0.102',
    //     hmr: {
    //         host: '192.168.0.102',
    //     },
    // },
    plugins: [
        laravel({
            input: [
                'resources/css/admin/main.css',
                'resources/css/components/main.css',
                'resources/css/frontend/app.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
