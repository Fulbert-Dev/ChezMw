import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/home-3d.js'],
            refresh: true,
        }),
    ],
    // PWA files (manifest, service worker, offline page, icons) stay in public/
    // so their URLs remain stable at the site root, which the SW scope requires.
});
