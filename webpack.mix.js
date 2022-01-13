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

mix.js('resources/js/app.js', 'public/js');

mix.sass('resources/scss/custom-styles/style.scss','public/css/fedca.css')
    .sass('resources/scss/custom-styles/fonts.scss','public/css/fonts.css')
    .sass('resources/scss/bootstrap/bootstrap.scss','public/css/bootstrap.css');
