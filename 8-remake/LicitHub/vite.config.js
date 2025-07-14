    import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 
                    'resources/css/cadastro.css',
                    'resources/js/cadastro.js', 
                    'resources/js/app.js',
                    'resources/js/admin.js',
                    'resources/css/admin.css',
                    'resources/css/welcome.css',
                    'resources/js/welcome.js',
                    'resources/css/login.css',
                    'resources/js/login.js',
                    'resources/css/esqueceu.css'],
                    
            refresh: true,
        }),
    ],
});
