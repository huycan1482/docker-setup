let mix = require('laravel-mix');

/*
|--------------------------------------------------------------------------
| Mix Asset Management
|--------------------------------------------------------------------------
|
| Mix provides a clean, fluent API for defining some Webpack build steps
| for your Laravel application. By default, we are compiling the Sass
| file for your application, as well as bundling up your JS files.
|
*/

mix.js('resources/js/admin/main.js', 'public/asset/js/admin/main.js');
mix.js('resources/js/admin/category.js', 'public/asset/js/admin/category.js');

mix.css('resources/css/admin/main.css', 'public/asset/css/admin/main.css');