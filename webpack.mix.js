const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss','public/css')
    .options({
        postCss: [
            require('postcss-import'),
            require('tailwindcss'),
            require('autoprefixer'),
        ]
    });
// ------------ General Bundle -------------
mix.js('resources/js/basic.js','public/js/basic.min.js');

// ------------ Protocols Bundle -------------
mix.babel([
    'resources/js/protocol/file_manager.js',
    'resources/js/protocol/base.js'
], 'public/js/protocol/protocol-bundle.js');

// ------------ Profile Bundle ---------------
mix.babel(['resources/js/profile.js'], 'public/js/profile-bundle.js');

// ------------ Charts -------------
mix.copy('node_modules/chart.js/dist/chart.min.js', 'public/js/chart.js/chart.min.js');
