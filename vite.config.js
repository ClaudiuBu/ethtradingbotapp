import { defineConfig } from 'vite';
import vite from 'laravel-vite-plugin';


export default defineConfig({
    plugins: [
        vite({
            input: [
                //css
                'resources/css/app.css', 
                //js
                'respurces/js/scripts.js',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
