let mix = require('laravel-mix');

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


mix.js('resources/assets/js/app.js', 'public/js');
mix.copy('resources/assets/js/form.js', 'public/js/form.js');
mix.sass('resources/assets/sass/app.scss', 'public/css');

// Cropper js
mix.copy('node_modules/croppie/croppie.css', 'public/css/');
mix.copy('node_modules/croppie/croppie.js', 'public/js/');


// mix.sass('node_modules/bootstrap/scss/_variables.scss', 'public/css/modal.css');
// mix.sass('node_modules/bootstrap/scss/_modal.scss', 'public/css/modal.css');
mix.copy('node_modules/bootstrap/js/src/modal.js', 'public/js/');