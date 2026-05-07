import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'node:fs';

export default defineConfig({
    publicDir: false,
    server: {
        host: '127.0.0.1',
        port: 5173,
        strictPort: true,
        origin: 'http://127.0.0.1:5173',
        hmr: {
            host: '127.0.0.1',
        },
    },
    plugins: [
        {
            name: 'ckeditor5-raw-svg',
            enforce: 'pre',
            load(id) {
                if (!id.endsWith('.svg')) {
                    return null;
                }

                const normalizedId = id.replace(/\\/g, '/');
                if (!/node_modules\/(?:@ckeditor|ckeditor5)\//.test(normalizedId)) {
                    return null;
                }

                const svg = fs.readFileSync(id, 'utf-8');
                return `export default ${JSON.stringify(svg)};`;
            },
        },
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
