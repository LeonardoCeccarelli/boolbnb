const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.disableSuccessNotifications(); //Rimuove le notifiche andate a buon fine dopo aver compilato

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/assets/apiAddress.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
