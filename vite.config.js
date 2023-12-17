import { defineConfig } from 'vite';
import { optimizeCssModules } from 'vite-plugin-optimize-css-modules';
import laravel from 'laravel-vite-plugin';
import livewire from '@defstudio/vite-livewire-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy'

export default defineConfig({
    plugins: [
        optimizeCssModules(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: false,
        }),
        livewire({  
            refresh: ['resources/css/app.css'], 
        }),
        viteStaticCopy({
            targets: [
                {
                    src: 'node_modules/@fortawesome/fontawesome-free/webfonts',
                    dest: '',
                },
            ],
        }),
    ],
});
