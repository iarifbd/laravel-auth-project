import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/main/app.css',
                'resources/js/main/app.js',
                'resources/css/adminkit_main/app.css',
                'resources/js/adminkit_main/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        return 'vendor'; // all dependencies from node_modules go into vendor.js
                    }
                },
            },
        },
        chunkSizeWarningLimit: 1000, // optional: increase warning limit if chunks are large
    },
});
