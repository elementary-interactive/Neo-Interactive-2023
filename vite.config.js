import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/style.scss', 'resources/js/app.js', 'resources/js/site.js'],
            refresh: true,
        }),
        // viteStaticCopy({
        //     targets: [
        //         {
        //             src: 'resources/fonts',
        //             dest: 'assets'
        //         },
        //         {
        //             src: 'resources/images',
        //             dest: 'assets'
        //         },
        //     ]
        // })
    ],
});